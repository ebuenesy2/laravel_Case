<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker;
use Illuminate\Support\Str;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 20 ; $i++) { 
           
            //! Veri Ekleme
            DB::table('customer')->insert([
                'name' => $faker->firstName,
                'surname' =>  $faker->lastName,
                'email' => $faker->email(),
                'company' => $faker->company(),
            ]); //! Veri Ekleme Son

        }
    }
}
