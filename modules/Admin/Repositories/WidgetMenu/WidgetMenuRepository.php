<?php

namespace Modules\Admin\Repositories\WidgetMenu;

interface WidgetMenuRepository {

    /**
     * Add a new menu to a widget.
     *
     * @param string $widgetID
     * 
     * @param string $menu
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function linkMenuWithWidget($widgetID, $menuID);

    /**
     * Get all the menus for a specific widget.
     *
     * @param String $widgetID
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAllMenus($widgetID);

    /**
     * Remove all the menus of a partcular widget.
     *
     * @param int $widgetID
     *
     * @param string $menu
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function removeAllMenus($widgetID);
}
