<?php

namespace Modules\Admin\Entities;

use Pingpong\Presenters\Model;

class WidgetPosition extends Model {

    protected $table = 'widget_positions';
    
    /**
     * @var array
     */
    protected $fillable = [
        'position',
    	'nutshell'
    ];
    
    public $timestamps  = false;

}
