<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'admin';
        $role_employee->description = 'El administrador del menu y las ordenes.';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'client';
        $role_manager->description = 'El cliente que genera ordenes.';
        $role_manager->save();
    }
}
