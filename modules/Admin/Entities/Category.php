<?php

namespace Modules\Admin\Entities;

use Pingpong\Presenters\Model;

class Category extends Model {

    /**
     * @var array
     */
    protected $fillable = ['id','name', 'slug', 'description', 'parent'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles() {
        return $this->hasMany(__NAMESPACE__ . '\\Article');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOptions($query) {
        return $query->lists('name', 'id');
    }

}
