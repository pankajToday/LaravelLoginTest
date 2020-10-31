<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =  new Faker();

       for ($i=1 ; $i<=10;$i++)
       {
           DB::table('products')->insert([
               'category_id' => rand(1,3),
               'product_name' => 'Product '.rand(00,99),
               'product_code' => Str::random(4),
                'product_img' => 'demo.png',
               'quantity' => rand(1,999),
               'price'=>rand(100,999),
               'description'=>Str::random(100),
               'created_at' =>\Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now(),
           ]);
       }
    }
}
