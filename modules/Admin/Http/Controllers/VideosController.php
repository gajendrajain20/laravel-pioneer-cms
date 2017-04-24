<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Modules\Admin\Validation\Video\VideoCreate;
use Modules\Admin\Validation\Video\VideoUpdate;
use Illuminate\Support\Str;
use Pingpong\Admin\Controllers\BaseController;
use Pingpong\Admin\Uploader\ImageUploader;
use Modules\Frontend\Http\Controllers\ArticleController;

class VideosController extends BaseController {

    /**
     * @var ImageUploader
     */
    protected $uploader;

    /**
     * @param ImageUploader $uploader
     */
    public function __construct(ImageUploader $uploader) {
        $this->uploader = $uploader;

        $this->repository = $this->getRepository();
    }

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
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound() {
        return $this->redirect('videos.index')
                        ->withFlashMessage('Video not found!')
                        ->withFlashType('danger');
    }

    /**
     * Display a listing of videos.
     *
     * @return Response
     */
    public function index($query = null) {
        $user=\Auth::user();
        $user_id=0;
        if(!$user->is('admin')){
            $user_id=$user->id;
        }
        if($query != null){
        	$selectedMonthString = $query['month_list'];
        	$time = strtotime($selectedMonthString);
        	$formattedSelectedMonth=date('F', $time);
        	$formattedSelectedYear=date('Y', $time);
        	$query['month_list_month']= $formattedSelectedMonth;
        	$query['month_list_year']= $formattedSelectedYear;
        
        }
        $videos = $this->repository->allOrSearch($query,$user_id);
        $users_list=array();
        $users = $this->repository->getAllUserNames();
        $users_list['0'] = 'All Users';
        foreach($users as $user){
        	$users_list[$user['id']] = $user['name'];
        }
        $refinedMonthList = array();
        $month_list = $this->repository->getVideosMonthList();
        foreach($month_list as $i => $month){
        	$refinedMonthList[$month->dates] = $month->dates;
        }
       
        $videos->users_list = $users_list;
        $videos->month_list = array('-1'=>'All Dates')+ $refinedMonthList;
        $no = $videos->firstItem();
        return $this->view('videos.index', compact('videos', 'no'));
    }

    /**
     * Search in all articles.
     *
     * @return Response
     */
    public function search()
    {
    	return $this->index(Input::get());
    }
    
    /**
     * Returns a listing of videos.
     *
     * @return array
     */
    public function getAllVideoNames()
    {
    	return $this->repository->getAllVideoNames();
    }
    /**
     * Returns a listing of videos.
     *
     * @return Elqeuent Object
     */
    public function getAllVideoNamesModel()
    {
    	return $this->repository->getAllVideoNamesModel();
    }
    /**
     * Show the form for creating a new videos.
     *
     * @return Response
     */
    public function create() {
        return $this->view('videos.create');
    }

    /**
     * Display the specified video.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id) {
        try {
            $videos = $this->repository->findBySlug($id);

            return $this->view('video.show', compact('videos'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Store a newly created video in storage.
     *
     * @return Response
     */
    public function store(VideoCreate $request) {

        $data = $request->all();

        $data['published_on'] = date('Y-m-d', strtotime($data['published_on']));
		$year = date('Y', strtotime($data['published_on']));
        $month = date('m', strtotime($data['published_on']));

        $data['user_id'] = \Auth::id();
        $data['slug'] = Str::slug($data['title']);
        
        if(!isset($data['show_featured_image'])){
            $data['show_featured_image']=0;
        }

        $videoData = $this->repository->create($data);
        $videoID = $videoData->id;

        $tags = explode(',', $data['tags']);
        $tags = array_filter($tags);

        if (!empty($tags)) {
           $tagController = new TagsController();
           $articleTagController = new ArticleTagsController;
           //Link all the tags with the post
           foreach ($tags as $tag) {
               $row = $tagController->addTag($tag);
               $tagID = $row['id'];
               $articleTagController->linkTagWithPost($videoID, $tagID, 'video');
           }
        }
        return $this->redirect('videos.index');
    }

    /**
     * Show the form for editing the specified video.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id) {
        try {
            $user = \Auth::user();
            $user_id = 0;
            if (!$user->is('admin')) {
                $user_id = $user->id;
            }
            $video = $this->repository->findBySlug($id,$user_id);
            if(!isset($video)){
                return $this->redirectNotFound();
            }
            $id = $video->id;
            $tagController = new TagsController();
            $articleTagController = new ArticleTagsController;
            $tagIDs = $articleTagController->getAllTags($id, 'video');
            $tagIDs = array_filter($tagIDs);
            if (!empty($tagIDs)) {
                foreach ($tagIDs as $tagID) {
                    $tag = $tagController->findById($tagID)['tag'];
                    $tags[] = $tag;
                }
                $_tags = implode(',', $tags);
                $video['tags'] = $_tags;
            }
            return $this->view('videos.edit', compact('video'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified video in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(VideoUpdate $request, $id) {
        try {

            $video = $this->repository->findById($id);

            $data = $request->all();

            $data['published_on'] = date('Y-m-d', strtotime($data['published_on']));
            
            $year = date('Y', strtotime($data['published_on']));
            $month = date('m', strtotime($data['published_on']));
            

            $data['user_id'] = \Auth::id();
            $data['slug'] = Str::slug($data['title']);
            
            if(!isset($data['show_featured_image'])){
                $data['show_featured_image']=0;
            }
            
            $tags = explode(',', $data['tags']);
            $tags = array_filter($tags);

            $articleTagController = new ArticleTagsController;
            if (!empty($tags)) {
                $tagController = new TagsController();
                $articleTagController = new ArticleTagsController;
                $articleTagController->removeAllTag($id, 'video');
                $tags = explode(',', $data['tags']);

                //Link all the tags with the post
                foreach ($tags as $tag) {
                    $row = $tagController->addTag($tag);
                    $tagID = $row['id'];
                    $articleTagController->linkTagWithPost($id, $tagID, 'video');
                }
            } else {
                $articleTagController->removeAllTag($id, 'video');
            }
            $video->update($data);

            return $this->redirect('videos.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified video from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id) {
        try {
            $this->repository->delete($id);

            return $this->redirect('videos.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
