<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Pingpong\Admin\Controllers\BaseController;

class MenuTypeController extends BaseController {

    public function __construct() {
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\MenuType\MenuTypeRepository';
        return app($repository);
    }

    /**
     * Add the specified tag in storage.

     * @param int $tagID
     *
     * @return array
     */
    public function getAll() {
        try {
            return $this->repository->getAll();
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

}
