<?php

namespace Modules\Admin\Repositories\Menu;

use Modules\Admin\Entities\Menu;
use Modules\Admin\Repositories\Menu\MenuRepository;

class EloquentMenuRepository implements MenuRepository {

    public function perPage() {
        return config('admin.menu.perpage');
    }

    public function getModel() {
        $model = config('admin.menu.model');

        return new $model();
    }

    public function allOrSearch($searchQuery = null) {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }

        return $this->search($searchQuery);
    }

    public function getAll() {
        return $this->getModel()->latest()->paginate($this->perPage());
    }

    public function search($searchQuery) {
        $search = "%{$searchQuery}%";

        return $this->getMenu()->where('title', 'like', $search)
                        ->orWhere('body', 'like', $search)
                        ->orWhere('id', '=', $searchQuery)
                        ->paginate($this->perPage())
        ;
    }

    public function findById($id) {
        return $this->getModel()->find($id);
    }

    public function findBy($key, $value, $operator = '=') {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

    public function findByKey($key, $value, $operator = '=') {
        return $this->getModel()->where($key, $operator, $value)->get();
    }
    
    public function delete($id) {
        $article = $this->findById($id);

        if (!is_null($article)) {
            $article->delete();

            return true;
        }

        return false;
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }
    
    public function getAllMenuNames()
    {
    	return $this->getModel()->orderBy('id', 'ASC')->get(['id','title','parent','url','custom','class']);
    }
    
    public function findWheterAParentMenu($id){
    	return $this->getModel()->where('parent', '=', $id)->get()->toArray();
    }
    
    public function  findUsingUrl($path){
    	return $this->getModel()->where('url', '=', $path)->orWhere('custom', '=', $path)->get()->toArray();
    }

}
