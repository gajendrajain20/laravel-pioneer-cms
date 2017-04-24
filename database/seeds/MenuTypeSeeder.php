<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\MenuType;

class MenuTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuType = array(
            'name'=>'Main Menu'
        );
        
        MenuType::create($menuType);
    }
}
