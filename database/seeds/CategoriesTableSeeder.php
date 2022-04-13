<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['cat 1','cat 2','cat 3','cat 4','cat 5'];

        foreach ($categories as $category) {

            Category::create([
                'name' => $category
            ]); // end of create Category

        } // end of foreach

    } // end of run

} // end of seeder
