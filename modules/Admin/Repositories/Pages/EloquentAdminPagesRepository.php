<?php

namespace Modules\Admin\Repositories\Pages;

use Pingpong\Admin\Repositories\Pages\EloquentPageRepository;

class EloquentAdminPagesRepository extends EloquentPageRepository {

    public function getModel() {
        $model = config('admin.adminArticle.model');
        return new $model();
    }
	
    public function getAllPageList()
    {
    	return $this->getPage()->get();
    }
    
    public function getUserModel()
    {
    	$model = config('admin.user.model');
    
    	return new $model();
    }
    
    public function getAllUserNames() {
    	return $this->getUserModel()->latest()->get();
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
    	return $this->getPage()->latest()->where('user_id', '=', $user_id)->paginate($this->perPage());
    }
    
    public function search($searchQuery,$user_id=0) {
    	$search = "%{$searchQuery['search']}%";
 
    	$query = $this->getModel();
    	$query = $query->where('type', '=', $searchQuery['type']);
    	
    	if (isset($searchQuery['status']) && $searchQuery['status'] != '') {
    		$query = $query->where('status', '=', $searchQuery['status']);
    	}
    	if (isset($searchQuery['month_list']) && $searchQuery['month_list'] != '-1') {
    		$query = $query->whereRaw('monthname(`published_on`) = \''.$searchQuery['month_list_month'].'\'');
    		$query = $query->whereRaw('year(`published_on`) = \''.$searchQuery['month_list_year'].'\'');
    	}
    	if (isset($searchQuery['user_id']) && $searchQuery['user_id']  != 0) {
    		$query = $query->where('user_id', '=', $searchQuery['user_id']);
    	}
    	
    	$query = $query->where(function ($subquery) use ($search) {
    	
    		$subquery->where('title', 'like', $search)
    		->orWhere('body', 'like', $search)
    		->orWhere('articles.id', '=', $search);
    	});
    		return $query->paginate($this->perPage());
    }
    
    public function getPagesMonthList(){
    	return \DB::select('CALL `getPagesMonthList`()');
    
    }
    
    public function findBySlug($id)
    {
        return $this->getPage()->where('slug',$id)->first();
    }
}
