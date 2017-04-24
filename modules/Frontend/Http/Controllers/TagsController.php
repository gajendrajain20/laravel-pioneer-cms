<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Http\Controllers\BaseController;
use Modules\Admin\Http\Controllers\ArticleTagsController;

class TagsController extends BaseController {
	
	protected $repository;
	
	function __construct(){
		parent::__construct();
		$this->repository = $this->getRepository();
	}

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\Tag\TagRepository';
        return app($repository);
    }
    
    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getArticleRepository() {
        $repository = 'Pingpong\Admin\Repositories\Articles\ArticleRepository';
        return app($repository);
    }

    
    /**
     * index action
     *
     * @return mixed
     */
    public function index($tagName = null) {
    	if($tagName !=null || $tagName != ''){
    		$category['name'] = $tagName;
    		$tag = $this->repository->findByName($tagName);
    		if($tag != 'NA'){
    			$articleTag = new ArticleTagsController();
    			$articles = $articleTag->getAllPosts($tag['id'], 'post');
				
    			//we can use category view to show all articles sharing same tags
    			return view($this->theme.'::category.index',compact('articles','category'));
    		}
    	}
		
    	
    }

}
