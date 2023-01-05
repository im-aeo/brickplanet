<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrateItem extends Model
{
    use HasFactory;

    protected $table = 'crate_items';

    protected $fillable = [
        'item_id',
        'crate_id',
        'rarity'
    ];

    public const RARITY_WEIGHTS = [
        6 => 0.4,
        5 => 1.5,
        4 => 4,
        3 => 9,
        2 => 18,
        1 => 56,
    ];

    public const RARITY_NAMES = [
        6 => 'Exotic',
        5 => 'Legendary',
        4 => 'Mythical',
        3 => 'Epic',
        2 => 'Rare',
        1 => 'Common'
    ];

    public const RARITY_COLORS = [
        6 => '#ffa114',
        5 => '#ff1414',
        4 => '#a514ff',
        3 => '#41ab17',
        2 => '#388bff',
        1 => '#ff00c8'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    public static function rarityName($rarity)
    {
        return self::RARITY_NAMES[$rarity] ?? 'Unknown';
    }

    public static function rarityColor($rarity)
    {
        return self::RARITY_COLORS[$rarity] ?? 'inherit';
    }

    public static function getWinningItem($id)
    {
        $items = self::where('crate_id', '=', $id)->get();
        $valuesAndWeights = [];
        $x = 0;

        foreach ($items as $item)
            $valuesAndWeights[$item->id] = self::RARITY_WEIGHTS[$item->rarity];

        $pick = mt_rand(1, array_sum($valuesAndWeights));

        foreach ($valuesAndWeights as $value => $weight) {
            if (($x += $weight) > $pick)
                return $value;
        }
    }
}
