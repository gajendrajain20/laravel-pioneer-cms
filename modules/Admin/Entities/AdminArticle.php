<?php

namespace Modules\Admin\Entities;

use Pingpong\Admin\Entities\Article;

class AdminArticle extends Article {

    protected $table = 'articles';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'user_id',
        'title',
        'meta_title',
        'meta_description',
        'slug',
        'body',
        'image',
        'show_featured_image',
        'status',
        'published_at',
        'published_on',
    ];

        /**
     * Get all of the posts for the user.
     */
    public function categories()
    {
        return $this->hasMany(config('admin.articleCategory.model'),'article_id', 'id');
    }
}
