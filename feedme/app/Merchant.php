<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $fillable = [
        'logoFileName', 'bannerFileName', 'message', 'amountOfVisitors'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function productCategories()
    {
        return $this->hasMany('App\ProductCategory');
    }

    protected $casts = [
        'deliveryMethod_takeaway' => 'boolean',
        'deliveryMethod_delivery' => 'boolean',
    ];













    






}
