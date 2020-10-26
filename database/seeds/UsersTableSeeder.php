<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'admin',
            'password' => bcrypt('admin'),
            'email'=>'admin@laravelforum.test',
            'admin'=> 1,
            'avatar'=> asset('avatars/avatar.png')
        ]);

        App\User::create([
            'name' => 'andromeda',
            'password' => bcrypt('password'),
            'email' => 'andromeda@gmail.com',
            'avatar' => asset('avatars/avatar1.png')
        ]);
    }
}
