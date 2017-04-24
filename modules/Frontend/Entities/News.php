<?php

namespace Modules\Frontend\Entities;

use Pingpong\Presenters\Model;

class News extends Model {

    protected $table = 'news';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'number',
    	'message',
    	'file'
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
