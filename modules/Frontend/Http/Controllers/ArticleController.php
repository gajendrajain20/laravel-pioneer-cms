<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Http\Controllers\BaseController;
use Modules\Admin\Http\Controllers\ArticleCategoryController;
use Modules\Admin\Http\Controllers\TagsController;
use Modules\Admin\Http\Controllers\ArticleTagsController;

class ArticleController extends BaseController {

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Pingpong\Admin\Repositories\Articles\ArticleRepository';
        return app($repository);
    }
    
    /**
     * index action
     *
     * @return mixed
     */
    public function index($id) {
//      $article = $this->getRepository()->findById($id);
        $article = $this->getRepository()->findBySlug($id);
        $article->views = ++$article->views;
        $article->update();
        $id = $article->id;
        $article = $article->toArray();
        
        //getting all the tags for this article
       	if(!empty(array_filter($article))){
        	$tagController = new TagsController();
        	$articleTagController = new ArticleTagsController();
        	$tagIDs = $articleTagController->getAllTags($id, 'post');
        	
        	$tagIDs = array_filter($tagIDs);
        	if (!empty($tagIDs)) {
        		foreach ($tagIDs as $tagID) {
        			$tag = $tagController->findById($tagID)['tag'];
        			$tags[] = $tag;
        		}
        		$_tags = implode(',', $tags);
        		$article['tags'] = $_tags;
        	}
        	$articleCategory = new ArticleCategoryController();
        	$categories = $articleCategory->getAllcategories($id);
        	$article['category_id'] = $categories;
       	}
       
        $articleCategory = new ArticleCategoryController();
        $categories = $articleCategory->getAllcategories($id);
        $category=0;
        if(!empty($categories)){
            $category=$categories[0];
        }
        return view($this->theme.'::article.index',compact('article','category'));
    }
    

    /**
     * index action
     *
     * @return mixed
     */
    public function preview() {
    	return view($this->theme.'::article.empty_preview');
    }
    
}
