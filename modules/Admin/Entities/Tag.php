<?php

namespace Modules\Admin\Entities;

use Pingpong\Presenters\Model;

class Tag extends Model {

    /**
     * @var array
     */
    protected $fillable = [
        'tag'
    ];

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeNewest($query) {
        return $query->orderBy('created_at', 'desc');
    }

}
