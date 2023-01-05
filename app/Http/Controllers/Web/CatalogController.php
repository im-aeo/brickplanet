<?php

namespace App\Http\Controllers\Web;

use App\Models\Item;
use App\Jobs\RenderUser;
use App\Models\Inventory;
use App\Models\ItemPurchase;
use App\Models\ItemReseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    public function index($type)
    {
        
         foreach (config('item_types') as $category) {
            
          if(in_array($type, $category)) {
            abort(404);
            }
         } 
           if ($type == 'recent') {
              $items = Item::where([['creator_id', '=', 1]])->orderBy('updated_at', 'DESC')->take(10)->get();

           }else{  
           
           $items = Item::where([['type', '=', $type]])->orderBy('updated_at', 'DESC')->take(10)->get();
           }
        return view('web.catalog.index')->with([
            'items' => $items
        ]);
    }

    public function item($id, $slug)
    {
        $item = Item::where('id', '=', $id)->firstOrFail();

        if ($slug != $item->slug() || !$item->public_view && (!Auth::check() || !Auth::user()->isStaff())) abort(404);

        $suggestions = Item::where([
            ['id', '!=', $item->id],
            ['public_view', '=', true],
            ['status', '=', 'approved'],
            ['type', '=', $item->type]
        ])->take(6)->inRandomOrder()->get();

        if (Auth::check() && $item->type == 'crate')
            $copiesOwned = Inventory::where([
                ['user_id', '=', Auth::user()->id],
                ['item_id', '=', $item->id]
            ])->count();

        return view('web.catalog.item')->with([
            'item' => $item,
            'suggestions' => $suggestions,
            'copiesOwned' => $copiesOwned ?? 0
        ]);
    }

    public function edit($id, $slug)
    {
        $item = Item::where('id', '=', $id)->firstOrFail();

        if ($slug != $item->slug() || !Auth::user()->canEditItem($item->id)) abort(404);

        return view('web.catalog.edit')->with([
            'item' => $item
        ]);
    }

    public function update(Request $request)
    {
        $item = Item::where('id', '=', $request->id)->firstOrFail();
        $onsale = $request->has('onsale');

        if (!Auth::user()->canEditItem($item->id)) abort(404);

        $validate = [
            'name' => ['required', 'min:3', 'max:70', 'regex:/^[a-z0-9 .\-!,\':;<>?()\[\]+=\/]+$/i'],
            'price' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'description' => ['max:1024']
        ];

        if ($onsale)
            $validate['price'] = ['required', 'numeric', 'min:0', 'max:1000000'];

        $this->validate($request, $validate);

        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->onsale = $onsale;
        $item->save();

        return redirect()->route('catalog.item', [$item->id, $item->slug()])->with('success_message', 'Item has been updated.');
    }

    public function purchase(Request $request)
    {
        $item = Item::where('id', '=', $request->id)->firstOrFail();
        $column = ($item->creator_type == 'user') ? 'currency' : 'vault';

        $listing = ItemReseller::where('id', '=', $request->reseller_id);
        $listing = ($listing->exists()) ? $listing->first() : [];
        $isReseller = ($request->has('reseller_id')) ? $listing->exists() : false;

        $amount = ($item->type == 'crate' && !$item->limited) ? $request->amount : 1;
        $amount = (is_numeric($amount)) ? $amount : 1;
        $price = $item->price * $amount;

        if ($isReseller) {
            $amount = 1;
            $price = $listing->price;
        }

        if (!Auth::user()->isStaff() && !$item->public_view) abort(404);

        if ($item->status != 'approved')
            return back()->withErrors(['This item is not approved.']);

        if (!$isReseller && $item->limited && $item->stock <= 0)
            return back()->withErrors(['This item is out of stock.']);

        if (!$isReseller && !$item->onsale())
            return back()->withErrors(['This item is not on sale.']);

        if ($isReseller && Auth::user()->id == $listing->seller->id)
            return back()->withErrors(['You can not buy your own item.']);

        if (Auth::user()->currency < $price && $price > 0)
            return back()->withErrors(['You do not have enough currency to purchase this item.']);

        if (!$isReseller && Auth::user()->ownsItem($item->id) && $item->type != 'crate')
            return back()->withErrors(['You already own this item.']);

        if ($item->type == 'bundle' && Auth::user()->ownsItemInBundle($item->id))
            return back()->withErrors(['You already own an item in this bundle so you are unable to purchase this.']);

        $seller = (!$isReseller) ? $item->creator : $listing->seller;
        $seller->timestamps = false;
        $seller->$column += round(($price / 1.3), 0, PHP_ROUND_HALF_UP);
        $seller->save();

        $myU = Auth::user();
        $myU->currency -= $price;
        $myU->save();

        for ($i = 0; $i < $amount; $i++) {
            if ($isReseller) {
                $inventory = $listing->inventory;
                $inventory->user_id = Auth::user()->id;
                $inventory->save();

                $listing->delete();

                if (!$seller->ownsItem($item->id) && $seller->isWearingItem($item->id)) {
                    $seller->takeOffItem($item->id);

                    RenderUser::dispatch($seller->id);
                }
            } else {
                $inventory = new Inventory;
                $inventory->user_id = Auth::user()->id;
                $inventory->item_id = $item->id;
                $inventory->save();
            }

            if ($item->type == 'bundle')
                Auth::user()->grantBundleItems($item->id);

            $purchase = new ItemPurchase;
            $purchase->seller_id = $seller->id;
            $purchase->buyer_id = Auth::user()->id;
            $purchase->item_id = $item->id;
            $purchase->ip = Auth::user()->lastIP();
            $purchase->price = (!$isReseller) ? $item->price : $listing->price;
            $purchase->save();

            if ($item->limited && $item->stock > 0) {
                $item->stock -= 1;
                $item->save();
            }
        }

        return back()->with('success_message', 'You now own this item!');
    }

    public function resell(Request $request)
    {
        $copy = Inventory::where([
            ['id', '=', $request->id],
            ['user_id', '=', Auth::user()->id]
        ])->firstOrFail();
        $isReselling = ItemReseller::where('inventory_id', '=', $copy->id)->exists();

        if (!$copy->item->limited || ($copy->item->limited && $copy->item->stock > 0) | $isReselling) abort(404);

        $this->validate($request, [
            'price' => ['required', 'numeric', 'min:1', 'max:1000000']
        ]);

        $reseller = new ItemReseller;
        $reseller->seller_id = Auth::user()->id;
        $reseller->item_id = $copy->item->id;
        $reseller->inventory_id = $copy->id;
        $reseller->price = $request->price;
        $reseller->save();

        return redirect()->route('catalog.item', [$copy->item->id, $copy->item->slug()])->with('success_message', 'Item has been put up for sale.');
    }

    public function takeOffSale(Request $request)
    {
        $copy = ItemReseller::where([
            ['id', '=', $request->id],
            ['seller_id', '=', Auth::user()->id]
        ])->firstOrFail();

        $id = $copy->item_id;
        $slug = Item::where('id', '=', $id)->first()->slug();

        $copy->delete();

        return redirect()->route('catalog.item', [$id, $slug])->with('success_message', 'Item has been taken off sale.');
    }
}
