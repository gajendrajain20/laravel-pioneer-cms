<?php

namespace Modules\Frontend\Repositories\News;

use Modules\Frontend\Repositories\News\NewsRepository;

class EloquentNewsRepository implements NewsRepository {

    public function getModel() {
        $model = config('frontend.news.model');
        return new $model();
    }
    
    public function perPage()
    {
    	return config('frontend.news.perpage');
    }

    public function findById($id) {
    	return $this->getModel()->find($id);
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }
    
    public function getAll()
    {
    	return $this->getModel()->latest()->paginate($this->perPage());
    }
    
    public function allOrSearch($searchQuery = null) {
    	if (is_null($searchQuery)) {
    		return $this->getAll();
    	}
    
    	return $this->search($searchQuery);
    }
    
    public function search($searchQuery) {
    	$search = "%{$searchQuery['search']}%";
    
    	$query = $this->getModel();

    	$query = $query->where(function ($subquery) use ($search) {
    
    		$subquery->where('name', 'like', $search)
    		->orWhere('message', 'like', $search);
    	});
    		return $query->paginate($this->perPage())
    		;
    }
    
    public function delete($id)
    {
    	$contact = $this->findById($id);

    	if (!is_null($contact)) {
    		$contact->delete();
    		
    		return true;
    	}
    
    	return false;
    }
}
