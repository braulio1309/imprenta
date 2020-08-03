<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      =>  'Omar Apestegui',
            'email'     =>  'omar@gmail.com',
            'password'  => Hash::make('1234'),
            'rol'       =>  'A'
        ]);
    }
}
