<?php

namespace Modules\Admin\Entities;

use Pingpong\Presenters\Model;

class Menu extends Model {

    /**
     * @var string
     */
    protected $presenter = 'Pingpong\Admin\Presenters\Article';

    /**
     * @var string
     */
    protected $table = 'menus';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'position',
        'type',
        'post_id',
        'custom',
        'parent',
        'status',
        'class',
        'url',
        'is_predefined',
        'published_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('Pingpong\Admin\Entities\User');
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

        static::deleting(function ($data) {
            // $data->deleteImage();
        });
    }

}
