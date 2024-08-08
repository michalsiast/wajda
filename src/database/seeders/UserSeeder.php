<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'admin',
            'email' => 'tjcymerys@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'lang' => 'pl'
        ]);
        \App\User::create([
            'name' => 'M. Kardaś',
            'email' => 'rescodev98@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'lang' => 'pl'
        ]);
        \App\User::create([
            'name' => 'Administrator',
            'email' => 'admin@palmax.com.pl',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'lang' => 'pl'
        ]);
    }
}
