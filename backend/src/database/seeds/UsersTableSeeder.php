<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_admin = new User();
        $user_admin->name = 'John Sas';
        $user_admin->email = 'admin@mysite.com';
        $user_admin->password = bcrypt('secret');
        $user_admin->is_verified =true;
        $user_admin->save();
    }
}
