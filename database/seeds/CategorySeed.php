<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1 ; $i<=4;$i++)
        {
            DB::table('categories')->insert([
                'category_name' => 'Category '.rand(00,99),
                'category_code' => Str::random(4),
                'status' => 1,
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }


    }
}
