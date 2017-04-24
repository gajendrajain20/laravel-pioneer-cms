<?php

namespace Modules\Admin\Repositories\Templates;

use Modules\Admin\Entities\Template;
use Modules\Admin\Repositories\Templates\TemplateRepository;

class EloquentTemplateRepository implements TemplateRepository {

    public function perPage() {
        return config('admin.template.perpage');
    }

    public function getModel() {
        $model = config('admin.template.model');

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
    
    public function findByFileName($fileName) {
    	return $this->getModel()->where('zip_name', '=', $fileName)->get()->toArray();
    }

    public function delete($id) {
        $template = $this->findById($id);

        if (!is_null($template)) {
            $template->delete();

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
}
