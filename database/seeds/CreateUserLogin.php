<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserLogin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
