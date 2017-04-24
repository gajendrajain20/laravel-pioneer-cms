<?php

namespace Modules\Admin\Entities;

use Pingpong\Presenters\Model;

class Video extends Model {

    /**
     * @var string
     */
    protected $presenter = 'Modules\Admin\Presenters\Video';

    /**
     * @var string
     */
    protected $table = 'videos';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'meta_title',
        'description',
        'meta_description',
        'image',
        'show_featured_image',
        'status',
        'published_on'
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

        static::deleting(function ($data) {
            $data->deleteImage();
        });
    }

    /**
     * @return bool
     */
    public function deleteImage() {
        $file = $this->present()->image_path;

        if (file_exists($file)) {
            @unlink($file);

            return true;
        }

        return false;
    }

}
