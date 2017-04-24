<?php

use Illuminate\Database\Seeder;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Pingpong\Trusty\Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',  // MUST USE admin, DO NOT CHANGE!
            'description' => '',
            'created_at' => new \Carbon\Carbon(),
            'updated_at' => new \Carbon\Carbon(),
        ]);

        $user = Pingpong\Admin\Entities\User::create([
            'name' => 'Site Admin',
            'email' => 'admin@mailinator.com',
            'password' => 'admin',
            'created_at' => new \Carbon\Carbon(),
            'updated_at' => new \Carbon\Carbon(),
        ]);

        $user->roles()->attach($role);
    }
}
