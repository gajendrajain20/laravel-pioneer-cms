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
            'description' => 'a role with every permission',
            'created_at' => new \Carbon\Carbon(),
            'updated_at' => new \Carbon\Carbon(),
        ]);
		
		//Creating the frontend user role
		$frontendRole = Pingpong\Trusty\Role::create([
            'name' => 'Frontend User',
            'slug' => 'frontend_user',  // MUST USE frontend_user, DO NOT CHANGE!
            'description' => 'Normal frontend user role',
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
