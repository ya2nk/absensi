<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            'name' => \Str::random(10),
            'email' => 'jajang.umara@gmail.com',
            'username' => '2015.11.0094',
            'password' => \Hash::make('password'),
        ]);
        
        
    }
}
