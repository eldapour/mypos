<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [1,2,3,4,5];
        $products = ['product 1','product 2','product 3','product 4'];

        foreach ($products as $product) {
            foreach ($categories as $category) {

                Product::create([
                    'category_id' => $category,
                    'name' => $product,
                    'desc' => $product,
                    'purchase_price' => 100,
                    'sale_price' => 150,
                    'stock' => 100,

                ]); // end of create products

            } // end of inner foreach

        } // end of foreach

    } // end of run

} // end of seeder
