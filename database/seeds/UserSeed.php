<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        for ($i=1 ; $i<=10;$i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' =>  Str::random(10),
                'email_verified_at' => now(),
                'mobile' => '98' . rand(0000, 9999) . rand(0000, 9999),
                'password' => bcrypt('password'), // password
                'active_status'=>1,
                'remember_token' => Str::random(10),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),

            ]);
        }
    }
}
