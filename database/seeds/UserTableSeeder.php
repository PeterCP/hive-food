<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();

        $eduardo = new User();
        $eduardo->name = 'Eduardo';
        $eduardo->email = 'e.alvarez.alcocer@gmail.com';
        $eduardo->password = bcrypt('9999696326');
        $eduardo->save();
        $eduardo->roles()->attach($role_admin);

        $admin = new User();
        $admin->name = 'Administrador';
        $admin->email = 'admin@hive.online';
        $admin->password = bcrypt('weallfit2017');
        $admin->save();
        $admin->roles()->attach($role_admin);

    }
}
