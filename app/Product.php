<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['image_path', 'profit_percent'];

    public function getImagePathAttribute()
    {
        return asset('uploads/products_images/' . $this->image);
    } // end ImagePathAttribute

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
    } // end get profit percent attribute

    public function category()
    {
        return $this->belongsTo(Category::class);
    } // end category

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    } // end of orders

} // end Product Model
