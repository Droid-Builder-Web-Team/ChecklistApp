<?php

use App\RoleUser;
use Illuminate\Database\Seeder;

class RolesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = RoleUser::create([
            'role_id' => '1',
            'user_id' => '1',
        ]);
    }
}
