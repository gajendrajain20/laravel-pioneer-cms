<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Pingpong\Admin\Controllers\BaseController;

class WidgetMenusController extends BaseController {

    public function __construct() {
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\WidgetMenu\WidgetMenuRepository';
        return app($repository);
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id) {
        try {
            $this->repository->delete($id);
            return true;
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Add the specified menu in storage.

     * @param string $menu
     *
     * @return Response
     */
    public function linkMenuWithWidget($widgetID, $menuID) {
        try {
            return $this->repository->linkMenuWithWidget($widgetID, $menuID);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get all the menus for the specified widget from storage.
     *
     * @param int $widgetID
     *
     * @return Response
     */
    public function getAllMenus($widgetID) {
        try {

            $menus = $this->repository->getAllMenus($widgetID);
            return $menus;
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove all the menus of a partcular widget.
     *
     * @param int $widgetID
     *
     * @param string $menu
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function removeAllMenus($widgetID) {
        try {
            $this->repository->removeAllMenus($widgetID);
            return true;
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

}
