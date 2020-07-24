<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'rahman bayu',
            'email' => 'rahman@gmail.com',
            'image' => 'assets/users/1.jpeg',
            'password' => Hash::make('111111')
        ]);
    }
}
