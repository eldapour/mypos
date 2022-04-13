<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    } // end of User relation

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_order')->withPivot('quantity');
    } // end of products

} // end of Order model
