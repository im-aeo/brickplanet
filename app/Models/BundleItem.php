<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleItem extends Model
{
    use HasFactory;

    protected $table = 'bundle_items';

    protected $fillable = [
        'item_id',
        'bundle_id'
    ];
}
