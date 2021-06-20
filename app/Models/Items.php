<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Items::class, 'item_id');
    }

    public function childItems()
    {
        return $this->hasMany(Items::class, 'item_id')->with('items');
    }
}
