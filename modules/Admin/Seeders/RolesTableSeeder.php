<?php

namespace Modules\Admin\Seeders;

use Illuminate\Database\Seeder;
use Pingpong\Trusty\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
        ]);

        Role::create([
            'name' => 'User',
            'slug' => 'user',
        ]);
    }
}
