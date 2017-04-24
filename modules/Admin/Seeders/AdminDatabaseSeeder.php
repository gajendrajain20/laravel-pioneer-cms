<?php

namespace Modules\Admin\Seeders;

use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(__NAMESPACE__.'\\OptionsTableSeeder');
        $this->call(__NAMESPACE__.'\\RolesTableSeeder');
        $this->call(__NAMESPACE__.'\\PermissionsTableSeeder');
        $this->call(__NAMESPACE__.'\\UsersTableSeeder');
        $this->call(__NAMESPACE__.'\\CategoriesTableSeeder');
    }
}
