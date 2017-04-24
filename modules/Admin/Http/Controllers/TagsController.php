<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Pingpong\Admin\Controllers\BaseController;
use App\Http\Requests\Request;

class TagsController extends BaseController {

    public function __construct() {
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
     * Remove the specified Tag from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id) {
        try {
            return $this->repository->delete($id);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Add the specified tag in storage.

     * @param string $tag
     *
     * @return Response
     */
    public function addTag($tag) {
        try {
            return $this->repository->addTag($tag);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Finds the specified tag unsing it's id from the storage.

     * @param int $tagID
     *
     * @return array
     */
    public function findById($tagID) {
        try {
            return $this->repository->findById($tagID);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified tag from the specified post from storage.
     *
     * @param int $postID
     * 
     * @param string $tag
     *
     * @return Response
     */
    public function removeTag($postID, $tag) {
        try {
            return $this->repository->removeTag($postID, $tag);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }
    
    /**
     * Finds the tags similar to given tag from database.
    
     * @param string $tag
     *
     * @return array
     */
    public function search() {
        try {
            if(\Request::has('query')){
                $query = \Request::get('query');
            }else{
                $query= '';
            }
            return json_encode($this->repository->search($query));
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

}
