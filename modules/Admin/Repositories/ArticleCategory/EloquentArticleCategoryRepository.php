<?php

namespace Modules\Admin\Repositories\ArticleCategory;

use Modules\Admin\Repositories\ArticleCategory\ArticleCategoryRepository;

class EloquentArticleCategoryRepository implements ArticleCategoryRepository {

    public function getModel() {
        $model = config('admin.articleCategory.model');

        return new $model();
    }

    public function findById($id) {
        return $this->getModel()->where('article_id', '=', $id)->get();
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }
	
    public function findByCategoryId($id) {
    	return $this->getModel()->where('category_id', '=', $id)->get();
    }
    
    public function linkCategoryWithArticle($articleID, $categoryID) {
        $exists = $this->getModel()->where('article_id', '=', $articleID)->where('category_id', '=', $categoryID)->get()->toArray();
        if (empty($exists)) {
            $data = array('article_id' => $articleID, 'category_id' => $categoryID);
            return $this->getModel()->create($data);
        } else {
            return $exists;
        }
    }

    public function getAllcategories($articleID) {
        return $this->findById($articleID)->pluck('category_id')->toArray();
    }

    public function removeAllcategories($articleID) {
        $categories = $this->findById($articleID)->toArray();
        foreach ($categories as $category) {
            $categoryID = $category['category_id'];
            $this->getModel()->where('article_id', '=', $articleID)->where('category_id', '=', $categoryID)->delete();
        }
    }
    
    

}
