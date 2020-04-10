<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function merchant()
    {
        return $this->belongsTo("App\Merchant");
    }

    protected $fillable = ['orderable'];

    protected $casts = [
        'available' => 'boolean',
        "orderable" => 'boolean'
    ];

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

}
