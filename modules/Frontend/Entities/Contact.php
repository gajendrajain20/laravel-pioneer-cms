<?php

namespace Modules\Frontend\Entities;

use Pingpong\Presenters\Model;

class Contact extends Model {

    protected $table = 'contacts';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
    	'message'
    ];
    
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(__NAMESPACE__ . '\\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(__NAMESPACE__ . '\\Category');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeNewest($query) {
        return $query->orderBy('created_at', 'desc');
    }

}
