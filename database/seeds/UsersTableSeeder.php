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
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $designerRole = Role::where('name', 'designer')->first();
        $userRole = Role::where('name', 'user')->first();


        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Skywalker94'),
        ]);
        $designer = User::create([
            'name' => 'Designer User',
            'email' => 'designer@designer.com',
            'password' => Hash::make('Skywalker94'),
        ]);
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('Skywalker94'),
        ]);
        $rob = User::create([
            'name' => 'Rob',
            'email' => 'robhowdle94@gmail.com',
            'password' => Hash::make('Skywalker94'),
        ]);

        $admin->roles()->attach($adminRole);
        $designer->roles()->attach($designerRole);
        $user->roles()->attach($userRole);
        $rob->roles()->attach($adminRole);
    }
}
