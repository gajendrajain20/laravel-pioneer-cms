<?php

namespace Modules\Admin\Repositories\Articles;

use Pingpong\Admin\Repositories\Articles\EloquentArticleRepository;

class EloquentAdminArticleRepository extends EloquentArticleRepository {

    public function getModel() {
        $model = config('admin.adminArticle.model');
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
    
    public function getAllArticleNames() {
        return $this->getArticle()->get(['id', 'title'])->toArray();
    }

    public function getAllArticleNamesModel() {
        return $this->getArticle()->get(['id', 'title']);
    }

    public function getAllPageNames() {
        return $this->getModel()->where("type", "=", "page")->get(['id', 'title'])->toArray();
    }

    public function getAllPageNamesModel() {
        return $this->getModel()->where("type", "=", "page")->get(['id', 'title']);
    }
	
    public function getAllPostData()
    {
    	return $this->getArticle()->get();
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

    public function findById($id,$user_id=0)
    {
        if($user_id==0){
            return $this->getArticle()->find($id);
        }else{
            return $this->getArticle()->where('user_id', '=', $user_id)->find($id);
        }
    }
    
    public function getSpecificAll($user_id)
    {	
        return $this->getArticle()->latest()->where('user_id', '=', $user_id)->paginate($this->perPage());
    }
    
    public function search($searchQuery) {
        $search = isset($searchQuery['search'])?"%{$searchQuery['search']}%":"";
		
        $query = $this->getModel();
        $query = $query->where('type', '=', $searchQuery['type']);
        if (isset($searchQuery['category']) && $searchQuery['category'] != 0) {
            $query = $query->join('article_categories', 'article_categories.article_id', '=', 'articles.id');
            $query = $query->where('article_categories.category_id', '=', $searchQuery['category']);
        }
        if (isset($searchQuery['month_list']) && $searchQuery['month_list'] != '-1') {
        	$query = $query->whereRaw('monthname(`published_on`) = \''.$searchQuery['month_list_month'].'\'');
        	$query = $query->whereRaw('year(`published_on`) = \''.$searchQuery['month_list_year'].'\'');
        }
        if (isset($searchQuery['status']) && $searchQuery['status'] != '') {
            $query = $query->where('status', '=', $searchQuery['status']);
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
        ;
    }
    
    public function searchPost($searchQuery,$limit,$page) {

        $query = $this->getModel();
        $query = $query->where('type', '=', $searchQuery['type']);
        if (isset($searchQuery['category_id'])) {
            $query = $query->join('article_categories', 'article_categories.article_id', '=', 'articles.id');
            $query = $query->where('article_categories.category_id', '=', $searchQuery['category_id']);
        }
        if (isset($searchQuery['status'])) {
            $query = $query->where('status', '=', $searchQuery['status']);
        }
        if (isset($searchQuery['published_on'])) {
            $query = $query->where('published_on', '<=', $searchQuery['published_on']);
        }
        if (isset($searchQuery['type'])) {
            $query = $query->where('type', '=', $searchQuery['type']);
        }
        $query=$query->orderBy('published_on', 'desc');
        return $query->take($limit)->get(['articles.id', 'slug', 'title', 'body', 'image', 'published_on','views']);
    }
    
    public function customSearchForArticles($searchQuery) {
    
    	$query = $this->getModel();
    	$query = $query->where('type', '=', 'post');
    	$query = $query->where('status' ,'=', '1');
    	
        if (isset($searchQuery['categories'])) {
			// filtering according to categories
        	$query = $query->join('article_categories', 'article_categories.article_id', '=', 'articles.id');
        	$query = $query->wherein('article_categories.category_id', $searchQuery['categories']);
        }
        if (isset($searchQuery['startDate'])) {
            $query = $query->where('published_at', '>=', $searchQuery['startDate']);
        }
        if (isset($searchQuery['endDate'])) {
            $query = $query->where('published_at', '<=', $searchQuery['endDate']);
        }
        
        if(isset($searchQuery['orderBy'])){
        	switch(strtolower($searchQuery['orderBy'])){
        		case "name": $query=$query->orderBy('title', 'asc');
        			break;
        		case "date":$query=$query->orderBy('published_at', 'asc');
        			break;
        		case "id": $query=$query->orderBy('id', 'asc');
        	}
        }
        
        if (isset($searchQuery['count'])) {
        	return $query->take($searchQuery['count'])->get(['articles.id', 'slug', 'title', 'body', 'image', 'published_on','views']);
        }else{
        	return $query->get(['articles.id', 'slug', 'title', 'body', 'image', 'published_on','views']);
        }
       
    }
    
    public function getArticlesMonthList(){
    	return \DB::select('CALL `getArticlesMonthList`()');
    	
    }
    
    public function findBySlug($id,$user_id=0)
    {
        if($user_id==0){
            return $this->getArticle()->where('slug',$id)->first();
        }else{
            return $this->getArticle()->where('user_id', $user_id)->where('slug',$id)->first();
        }
    }

}
