<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Template;

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     Template::truncate();

        $template = array(
                'name' => 'default',
                'user_id' => '1',
                'zip_name'=> 'default'
            );

       Template::create($template);
    }
}
