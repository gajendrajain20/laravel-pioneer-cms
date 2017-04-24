<?php

namespace Modules\Admin\Repositories\Modules;

use Modules\Admin\Repositories\Modules\ModuleRepository;

class EloquentModuleRepository implements ModuleRepository {

    public function perPage() {
        return config('admin.module.perpage');
    }

    public function getModel() {
        $model = config('admin.module.model');

        return new $model();
    }

    public function getAll() {
        return $this->getModel()->paginate($this->perPage());
    }

    public function allOrSearch($userID = null) {
        if (is_null($userID)) {
            return $this->getAll();
        }

        return $this->search($userID);
    }
    
    public function findById($id) {
        return $this->getModel()->find($id);
    }

    public function delete($id) {
        $module = $this->findById($id);

        if (!is_null($module)) {
            $module->delete();

            return true;
        }

        return false;
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }
    
    public function search($userID) {
        $query=$this->getModel();

        $query = $query->where('user_id', '=', $search);
        return $query->paginate($this->perPage());
    }
    
    public function getAllModulesNames(){
    	return $this->getModel()->get(['route_name as id','name as title'])->toArray();
    }
}
