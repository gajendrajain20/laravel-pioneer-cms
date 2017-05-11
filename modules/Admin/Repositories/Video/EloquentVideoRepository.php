<?php

namespace Modules\Admin\Repositories\Video;

use Modules\Admin\Entities\Video;
use Modules\Admin\Repositories\Video\VideoRepository;

class EloquentVideoRepository implements VideoRepository {

    public function perPage() {
        return config('admin.video.perpage');
    }

    public function getModel() {
        $model = config('admin.video.model');

        return new $model();
    }
	
    public function getUserModel()
    {
    	$model = config('admin.user.model');
    
    	return new $model();
    }
    
    public function getAllUserNames() {
    	return $this->getUserModel()->latest()->get();
    }
    
    
    public function getAll() {
        return $this->getModel()->latest()->paginate($this->perPage());
    }

    public function allOrSearch($searchQuery = null,$user_id=0) {
        if (is_null($searchQuery)) {
            if($user_id==0){
            return $this->getAll();
            }else{
                return $this->getSpecificAll($user_id);
            } 
        }

        return $this->search($searchQuery);
    }

    public function getSpecificAll($user_id)
    {	
        return $this->getModel()->latest()->where('user_id', '=', $user_id)->paginate($this->perPage());
    }
    
    public function findById($id,$user_id=0)
    {
        if($user_id==0){
        return $this->getModel()->find($id);
        }else{
            return $this->getModel()->where('user_id', '=', $user_id)->find($id);
        }
    }

    public function delete($id) {
        $video = $this->findById($id);

        if (!is_null($video)) {
            $video->delete();
            return true;
        }
        return false;
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }
    public function getAllVideoNames()
    {
    	return $this->getModel()->get(['slug as id','title'])->toArray();
    }
    public function getAllVideoNamesModel()
    {
    	return $this->getModel()->get(['id','title']);
    }

    public function search($searchQuery) {
        $search = "%{$searchQuery['search']}%";
        
        $query=$this->getModel();
        
        if (isset($searchQuery['user_id']) && $searchQuery['user_id']  != 0) {
        	$query = $query->where('user_id', '=', $searchQuery['user_id']);
        }
        if (isset($searchQuery['month_list']) && $searchQuery['month_list'] != '-1') {
        	$query = $query->whereRaw('monthname(`published_on`) = \''.$searchQuery['month_list_month'].'\'');
        	$query = $query->whereRaw('year(`published_on`) = \''.$searchQuery['month_list_year'].'\'');
        }
        
        if (isset($searchQuery['status']) && $searchQuery['status'] != '') {
            $query = $query->where('status', '=', $searchQuery['status']);
        }
        $query = $query->where(function ($subquery) use ($search) {
            
            $subquery->where('title', 'like', $search)
                    ->orWhere('id', '=', $search);
        });

        return $query->paginate($this->perPage());
    }
    
    public function searchPost($searchQuery,$limit,$page) {

        $query = $this->getModel();
        if (isset($searchQuery['status'])) {
            $query = $query->where('status', '=', $searchQuery['status']);
        }
        if (isset($searchQuery['published_on'])) {
            $query = $query->where('published_on', '<=', $searchQuery['published_on']);
        }
        $query=$query->orderBy('published_on', 'desc');
        return $query->take($limit)->get(['id', 'title', 'slug', 'description', 'image', 'published_on','views']);
    }
    
    public function getVideosMonthList(){
    	return \DB::select('CALL `getVideosMonthList`()');
    	 
    }
    
    public function findBySlug($id,$user_id=0)
    {
        if($user_id==0){
             return $this->getModel()->where('slug', $id)->first();
        }else{
            return $this->getModel()->where('user_id', '=', $user_id)->where('slug', $id)->first();
        }
    }
}
