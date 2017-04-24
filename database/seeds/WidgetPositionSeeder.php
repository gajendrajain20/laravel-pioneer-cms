<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\WidgetPosition;

class WidgetPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = array(
            array(
                'position' => 'left-a',
                'nutshell' => 'left position A',
            ),
            array(
                'position' => 'left-b',
                'nutshell' => 'left position B',
            ),
            array(
                'position' => 'right-a',
                'nutshell' => 'right position A',
            ),
            array(
                'position' => 'right-b',
                'nutshell' => 'right position B',
            )
        );
        
        foreach ($positions as $position){
            WidgetPosition::create($position);
        }
    }
}
