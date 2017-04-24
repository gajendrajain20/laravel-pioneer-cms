<?php

namespace Modules\Admin\Entities;

use Pingpong\Presenters\Model;

class MenuType extends Model {

    protected $table = 'menu_type';
    
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

}
