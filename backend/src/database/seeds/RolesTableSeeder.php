<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'developer';
        $role_employee->description = 'A Super Admin User';
        $role_employee->save();

        $role_employee = new Role();
        $role_employee->name = 'super_admin';
        $role_employee->description = 'A Super Admin User';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'An Admin User';
        $role_manager->save();

        $role_manager = new Role();
        $role_manager->name = 'affiliate';
        $role_manager->description = 'An Affiliate User';
        $role_manager->save();

        $role_manager = new Role();
        $role_manager->name = 'member';
        $role_manager->description = 'A Normal User';
        $role_manager->save();
    }
}
