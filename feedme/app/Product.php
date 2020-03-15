<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order() //milat: hier probleem
    {
        return $this->belongsToMany('App\Order');
    }

}
