<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Http\Controllers\BaseController;

class CategoryController extends BaseController {

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Pingpong\Admin\Repositories\Categories\CategoryRepository';
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
    public function index($id = null) {
        $category = $this->getRepository()->findById($id)->toArray();
        $query=array('search'=>'','category'=>$id,'status'=>'1','published_on'=>date('Y-m-d'),'type'=>'post');
        
        $articles = $this->getArticleRepository()->allOrSearch($query);
        return view($this->theme.'::category.index',compact('articles','category'));
    }

}
