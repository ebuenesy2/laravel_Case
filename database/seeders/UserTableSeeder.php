<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //! Veri Ekleme
        DB::table('users')->insert([
            'name' => "admin",
            'surname' => "surname",
            'email' => "admin@example.com",
            'password' => "password",
            'role' => 1,
        ]); //! Veri Ekleme Son

        //! Veri Ekleme
        DB::table('users')->insert([
            'name' => "personel",
            'surname' => "surname",
            'email' => "staff@example.com",
            'password' => "password",
            'role' => 2,
        ]); //! Veri Ekleme Son
    }
}
