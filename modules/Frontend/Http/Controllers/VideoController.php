<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Http\Controllers\BaseController;

class VideoController extends BaseController {

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\Video\VideoRepository';
        return app($repository);
    }
    
    /**
     * index action
     *
     * @return mixed
     */
    public function index() {
        $videos = $this->getRepository()->allOrSearch(null);
        
        return view($this->theme.'::video.index',compact('videos'));
    }
    
    /**
     * index action
     *
     * @return mixed
     */
    public function getVideoById($id = null) {
        //$video = $this->getRepository()->findById($id);
        $video = $this->getRepository()->findBySlug($id);
        $video->views = ++$video->views;
        $video->update();
        $video = $video->toArray();
        
        return view($this->theme.'::video.video',compact('video'));
    }

}
