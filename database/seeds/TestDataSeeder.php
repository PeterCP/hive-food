<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleClient = Role::where('name', 'client')->first();

        $client = new User();
        $client->name = 'Test Client';
        $client->email = 'client@example.com';
        $client->password = bcrypt('password');
        $client->save();
        $client->roles()->attach($roleClient);
    }
}
