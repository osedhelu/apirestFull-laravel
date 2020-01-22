<?php

use App\User;
use App\Category;
use App\Transaction;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Category::truncate();
        Transaction::truncate();
        Product::truncate();
        DB::table('category_product')->truncate();


        $catidadUsers = 18;
        $catidadcategory = 50;
        $catidadProductos = 50;
        $catidadtransaction = 20;

        factory(User::class, $catidadUsers)->create();
        factory(Category::class, $catidadcategory)->create();

        factory(Product::class, $catidadProductos)->create()->each(
            function ($productos) {
                $category = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $productos->categories()->attach($category);
            }
        );
        
        factory(Transaction::class, $catidadtransaction)->create();
    }
}
