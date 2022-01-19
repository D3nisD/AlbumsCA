<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Hash;
use App\Models\Role;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'Deniss Danilov';
        $admin->email = 'D3nisd@album.ie';
        $admin->password = Hash::make('password');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'John Jones';
        $user->email = 'joejo@album.ie';
        $user->password = Hash::make('password');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
