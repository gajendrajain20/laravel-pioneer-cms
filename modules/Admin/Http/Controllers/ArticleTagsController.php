<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Pingpong\Admin\Controllers\BaseController;

class ArticleTagsController extends BaseController {

    public function __construct() {
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\ArticleTag\ArticleTagRepository';
        return app($repository);
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param int $id
     * 
     * @param string $type
     *
     * @return Response
     */
    public function destroy($id, $type) {
        try {
            $this->repository->delete($id, $type);
            return true;
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create a artile-tag binding in storage.
     * 
     * @param int $postID
     *
     * @param init $tagID
     * 
     * @param string $type
     *   
     * @return Response
     */
    public function linkTagWithPost($postID, $tagID, $type) {
        try {
            return $this->repository->linkTagWithPost($postID, $tagID, $type);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get all the tags for the specified post from storage.
     *
     * @param int $postID
     * 
     * @param string $type
     *
     * @return Response
     */
    public function getAllTags($postID, $type) {
        try {

            $tags = $this->repository->getAllTags($postID, $type);
            return $tags;
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }
    
    /**
     * Get all the posts having specified tag from storage.
     *
     * @param int $tagID
     * 
     * @param string $type
     *
     * @return Response
     */
    public function getAllPosts($tagID, $type) {
    	try {
    		return $this->repository->getAllPosts($tagID, $type);
    	} catch (ModelNotFoundException $e) {
    		return $e->getMessage();
    	}
    }

    /**
     * Remove all the tags of a partcular post.
     *
     * @param int $postID
     *
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function removeAllTag($postID, $type) {
        try {
            return $this->repository->removeAllTag($postID, $type);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

}
