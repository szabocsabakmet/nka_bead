<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userRole = new Role([
            'name' => 'user'
        ]);

        $userRole->save();


        $admin = new User([
            'name' => 'Administrator',
            'email' => 'admin@nka-shop.com',
            'password' => Hash::make(env('ADMIN_PASSWORD')),
        ]);

        $admin->save();

        $adminRole = new Role([
            'name' => 'administrator'
        ]);
        $adminRole->save();

        $admin->assignRole($adminRole);

        $user = new User([
            'name' => 'User',
            'email' => 'user@nka-shop.com',
            'password' => Hash::make(env('USER_PASSWORD')),
        ]);

        $user->save();

    }
}
