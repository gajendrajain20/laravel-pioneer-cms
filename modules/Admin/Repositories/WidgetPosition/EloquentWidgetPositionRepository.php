<?php

namespace Modules\Admin\Repositories\WidgetPosition;

use Modules\Admin\Entities\WidgetPosition;
use Modules\Admin\Repositories\WidgetPosition\WidgetPositionRepository;

class EloquentWidgetPositionRepository implements WidgetPositionRepository {

    public function getModel() {
        $model = config('admin.widgetposition.model');
        return new $model();
    }


    public function perPage() {
        return config('admin.widgetposition.perpage');
    }
  
    
    public function getAll() {
        return $this->getModel()->paginate($this->perPage());
    }
    
    public function getAllPositions() {
    	return $this->getModel()->get();
    }
    

    public function allOrSearch($searchQuery = null) {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }else{
        	return $this->search($searchQuery);
        }
    }

    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    public function delete($id) {
        $position = $this->findById($id);

        if (!is_null($position)) {
            $position->delete();
            return true;
        }
        return false;
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }

}
