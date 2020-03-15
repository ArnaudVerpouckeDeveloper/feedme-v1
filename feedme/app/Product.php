<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function merchant()
    {
        return $this->belongsTo("App\Merchant");
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

}
