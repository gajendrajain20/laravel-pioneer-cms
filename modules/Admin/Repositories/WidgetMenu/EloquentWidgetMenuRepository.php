<?php

namespace Modules\Admin\Repositories\WidgetMenu;

use Modules\Admin\Repositories\WidgetMenu\WidgetMenuRepository;

class EloquentWidgetMenuRepository implements WidgetMenuRepository {

    public function getModel() {
        $model = config('admin.widgetMenu.model');

        return new $model();
    }

    public function findById($id) {
        return $this->getModel()->where('widget_id', '=', $id)->get();
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }

    public function linkMenuWithWidget($widgetID, $menuID) {
        $exists = $this->getModel()->where('widget_id', '=', $widgetID)->where('menu_id', '=', $menuID)->get()->toArray();
        if (empty($exists)) {
            $data = array('widget_id' => $widgetID, 'menu_id' => $menuID);
            return $this->getModel()->create($data);
        } else {
            return $exists;
        }
    }

    public function getAllMenus($widgetID) {
        $allmenus = $this->findById($widgetID)->pluck('menu_id')->toArray();
        return $allmenus;
    }

    public function removeAllMenus($widgetID) {
        $menus = $this->findById($widgetID)->toArray();
        foreach ($menus as $menu) {
            $menuID = $menu['menu_id'];
            $this->getModel()->where('widget_id', '=', $widgetID)->where('menu_id', '=', $menuID)->delete();
        }
    }
    
    public function getAllChildMenus($id){
    	return \DB::select("call get_tree('".$id."')");
    }

}
