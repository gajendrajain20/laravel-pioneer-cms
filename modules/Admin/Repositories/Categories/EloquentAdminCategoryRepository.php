<?php

namespace Modules\Admin\Repositories\Categories;

use Pingpong\Admin\Repositories\Categories\EloquentCategoryRepository;

class EloquentAdminCategoryRepository extends EloquentCategoryRepository
{
    public function getModel()
    {
        $model = config('admin.category.model');

        return new $model();
    }
	
    public function getAllCategoryNames()
    {
		return $this->getModel()->get(['id','name as title', 'parent'])->toArray();
    }
    
    public function getAllCategoryNamesModel()
    {
    	return $this->getModel()->get(['id','name as title']);
    }
    public function findWheterAParentCategory($id){
    	return $this->getModel()->where('parent', '=', $id)->get()->toArray();
    }
    
}
