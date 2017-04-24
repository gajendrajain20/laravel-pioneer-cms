<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Pingpong\Admin\Controllers\BaseController;

class ArticleCategoryController extends BaseController {

    public function __construct() {
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\ArticleCategory\ArticleCategoryRepository';
        return app($repository);
    }


    /**
     * Add the specified Category & Article linking in storage.
	 *
     * @param int $A
     *
     * @param int $categoryID
     *
     * @return Response
     */
    public function linkCategoryWithArticle($articleID, $categoryID) {
        try {
            return $this->repository->linkCategoryWithArticle($articleID, $categoryID);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get all the categorys for the specified article from storage.
     *
     * @param int $articleID
     *
     * @return Response
     */
    public function getAllcategories($articleID) {
        try {

            $categorys = $this->repository->getAllcategories($articleID);
            return $categorys;
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove all the categorys of a partcular article.
     *
     * @param int $articleID
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function removeAllcategories($articleID) {
        try {
            $this->repository->removeAllcategories($articleID);
            return true;
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }
    
    /**
     * Find all articles with a specific category ID.
     *
     * @param int $categoryID
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByCategoryId($categoryID) {
    	try {
    		return $this->repository->findByCategoryId($categoryID);
    	} catch (ModelNotFoundException $e) {
    		return $e->getMessage();
    	}
    }

}
