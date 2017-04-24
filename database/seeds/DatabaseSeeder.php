<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RoleAndUserSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TemplatesTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(MenuTypeSeeder::class);
        Model::reguard();
    }
}
