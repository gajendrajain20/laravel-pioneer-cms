<?php

namespace Modules\Admin\Entities;

use Pingpong\Presenters\Model;

class Template extends Model {

    /**
     * @var string
     */
    protected $table = 'templates';
	
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'zip_name'
    ];
	
   
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('Pingpong\Admin\Entities\User');
    }


    /**
     * Boot the eloquent.
     */
    public static function boot() {
        parent::boot();

    }

}
