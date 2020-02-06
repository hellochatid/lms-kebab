<?php

use Illuminate\Database\Seeder;
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
        $role_admin  = Role::where('name', 'admin')->first();

        $user_admin = new User();
        $user_admin->name = 'John Sas';
        $user_admin->email = 'admin@mysite.com';
        $user_admin->password = bcrypt('secret');
        $user_admin->is_verified =true;
        $user_admin->save();
        $user_admin->roles()->attach($role_admin);
    }
}
