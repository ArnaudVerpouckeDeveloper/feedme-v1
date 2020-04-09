<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'accepted', 'denied', 'extraTime'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function customer()
    {
        return $this->belongsTo("App\Customer");
    }  
}
