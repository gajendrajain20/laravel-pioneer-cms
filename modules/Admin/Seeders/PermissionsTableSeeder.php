<?php

namespace Modules\Admin\Seeders;

use Illuminate\Database\Seeder;
use Pingpong\Trusty\Role;
use Pingpong\Trusty\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = array(
            'Manage Users',
            'Manage Articles',
            'Manage Pages',
            'Manage Categories',
            'Manage Settings',
            'Manage Roles',
            'Manage Permissions',
        	'Manage Videos',
        	'Manage Menus',
        	'Manage Widgets',
        	'Manage Contacts',
        	'Manage News',
        		
        );

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'slug' => $permission,
                'description' => $permission,
            ]);
        }

        $permissions = Permission::lists('id')->toArray();

        Role::find(1)->permissions()->attach($permissions);
    }
}
