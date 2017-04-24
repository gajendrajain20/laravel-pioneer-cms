<?php

namespace Modules\Admin\Repositories\ArticleTag;

interface ArticleTagRepository {

    /**
     * Add a new tag to a post.
     *
     * @param string $postID
     * 
     * @param string $tag
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function linkTagWithPost($postID, $tagID, $type);

    /**
     * Get all the tags for a specific post.
     *
     * @param String $postID
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAllTags($postID, $type);

    /**
     * Remove all the tags of a partcular post.
     *
     * @param int $postID
     *
     * @param string $tag
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function removeAllTag($postID, $type);
}
