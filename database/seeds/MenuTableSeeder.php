<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Menu;
use Carbon\Carbon AS Carbon;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menus = array(
            array(
                'user_id'        => '1',
                'title'         => 'Home',
                'slug'          => 'home',
                'position'      => '4',
                'post_id'       => '0',
                'custom'        => '/',
                'parent'        => '0',
                'status'        => '1',
                'published_at'  => Carbon::now(),
                'created_at'    => Carbon::now()
            ),
            array(
                'user_id'        => '1',
                'title'         => 'News',
                'slug'          => 'news',
                'position'      => '5',
                'post_id'       => '0',
                'custom'        => '/submit-news/',
                'parent'        => '0',
                'status'        => '1',
                'published_at'  => Carbon::now(),
                'created_at'    => Carbon::now()
            ),

            array(
                'user_id'        => '1',
                'title'         => 'Contact Us',
                'slug'          => 'contact-us',
                'position'      => '6',
                'post_id'       => '0',
                'custom'        => '/contact/',
                'parent'        => '0',
                'status'        => '1',
                'published_at'  => Carbon::now(),
                'created_at'    => Carbon::now()
            ),

        );

        foreach($menus as $menu){
            Menu::create($menu);
        }
    }
}
