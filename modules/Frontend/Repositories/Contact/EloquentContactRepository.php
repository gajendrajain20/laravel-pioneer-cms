<?php

namespace Modules\Frontend\Repositories\Contact;

use Modules\Frontend\Repositories\Contact\ContactRepository;

class EloquentContactRepository implements ContactRepository {

    public function getModel() {
        $model = config('frontend.contact.model');
        return new $model();
    }
    
    public function perPage()
    {
    	return config('admin.contact.perpage');
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
    		->orWhere('message', 'like', $search)
    		->orWhere('subject', '=', $search);
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
