<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Http\Controllers\BaseController;

class PageController extends BaseController {

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Pingpong\Admin\Repositories\Pages\PageRepository';
        return app($repository);
    }
    
    /**
     * index action
     *
     * @return mixed
     */
    public function index($id = null) {
//         $page = $this->getRepository()->findById($id);
        $page = $this->getRepository()->findBySlug($id);
        $page->views = ++$page->views;
        $page->update();
        $page = $page->toArray();
        return view($this->theme.'::page.index',compact('page'));
    }

}
