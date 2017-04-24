<?php

namespace Modules\Admin\Repositories\ArticleTag;

use Modules\Admin\Repositories\ArticleTag\ArticleTagRepository;

class EloquentArticleTagRepository implements ArticleTagRepository {

    public function getModel() {
        $model = config('admin.articleTag.model');

        return new $model();
    }
	
    public function perPage()
    {
    	return config('admin.articleTag.perpage');
    }
    
    public function findById($id, $type) {
        return $this->getModel()->where('article_id', '=', $id)->where('type', '=', $type)->get();
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }

    public function linkTagWithPost($postID, $tagID, $type) {
        $exists = $this->getModel()->where('article_id', '=', $postID)->where('tag_id', '=', $tagID)->where('type', '=', $type)->get()->toArray();
        if (empty($exists)) {
            $data = array('article_id' => $postID, 'tag_id' => $tagID, 'type' => $type);
            return $this->getModel()->create($data);
        } else {
            return $exists;
        }
    }

    public function getAllTags($postID, $type) {
        $allTags = $this->findById($postID, $type)->pluck('tag_id')->toArray();
        return $allTags;
    }

    public function removeAllTag($postID, $type) {
        $tags = $this->findById($postID, $type)->toArray();
        foreach ($tags as $tag) {
            $tagID = $tag['tag_id'];
            $deleted = $this->getModel()->where('article_id', '=', $postID)->where('tag_id', '=', $tagID)->where('type', '=', $type)->delete();
           	if(!$deleted){
           		return false;
           	}
        }
        return true;
    }
    
    public function getAllPosts($tagID, $type){
    	return $this->getModel()->where('article_tags.tag_id', '=', $tagID)->where('article_tags.type', '=', $type)
    		->join('articles', 'article_id', '=', 'id')->paginate($this->perPage());
    }

}
