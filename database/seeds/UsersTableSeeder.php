<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'fname' => 'Admin',
            'lname' => 'User',
            'uname' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Password1'),
        ]);
    }
}
