<?php

namespace Modules\Admin\Entities;

use Pingpong\Presenters\Model;

class Widget extends Model {

    /**
     * @var string
     */
    protected $table = 'widgets';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'position',
        'class',
        'device',
        'show_title',
    	'show_popup',
    	'module',
    	'params',
        'status',
        'days_count'
    ];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('Pingpong\Admin\Entities\User');
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

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopePublished($query) {
        return $query->whereNotNull('published_at');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeDrafted($query) {
        return $query->whereNull('published_at');
    }

    /**
     * Boot the eloquent.
     */
    public static function boot() {
        parent::boot();

    }

}
