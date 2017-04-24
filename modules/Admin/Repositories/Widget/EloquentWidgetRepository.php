<?php

namespace Modules\Admin\Repositories\Widget;

use Modules\Admin\Entities\Widget;
use Modules\Admin\Repositories\Widget\WidgetRepository;

class EloquentWidgetRepository implements WidgetRepository {

    public function perPage() {
        return config('admin.widget.perpage');
    }

    public function getModel() {
        $model = config('admin.widget.model');

        return new $model();
    }

    public function getAll() {
        return $this->getModel()->latest()->paginate($this->perPage());
    }

    public function allOrSearch($searchQuery = null) {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }

        return $this->search($searchQuery);
    }
    
    public function findById($id) {
        return $this->getModel()->find($id);
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
    
    public function search($searchQuery) {
        $search = "%{$searchQuery['search']}%";
        
        $query=$this->getModel();

        $query = $query->where(function ($subquery) use ($search) {
            
            $subquery->where('title', 'like', $search)
                    ->orWhere('id', '=', $search);
        });

        return $query->paginate($this->perPage());
    }

    public function searchWidgets($searchQuery) {

        $query = $this->getModel();
        if (isset($searchQuery['menu_id'])) {
            $query = $query->join('widget_menus', 'widget_menus.widget_id', '=', 'widgets.id');
            $query = $query->where('widget_menus.menu_id', '=', $searchQuery['menu_id']);
        }
        if (isset($searchQuery['position'])) {
            $query = $query->join('widget_positions', 'widget_positions.id', '=', 'widgets.position');
            $query = $query->where('widget_positions.position', '=', $searchQuery['position']);
        }
        
        return $query->get();
    }
    
}
