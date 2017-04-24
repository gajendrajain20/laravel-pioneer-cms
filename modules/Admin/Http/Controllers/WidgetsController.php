<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Modules\Admin\Validation\Widget\WidgetCreate;
use Modules\Admin\Validation\Widget\WidgetUpdate;
use Pingpong\Admin\Controllers\BaseController;
use Modules\Admin\Http\Controllers\WidgetPositionController;

class WidgetsController extends BaseController {

    public function __construct() {
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\Widget\WidgetRepository';
        return app($repository);
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound() {
        return $this->redirect('widgets.index')
                        ->withFlashMessage('Widget not found!')
                        ->withFlashType('danger');
    }

    /**
     * Display a listing of widgets.
     *
     * @return Response
     */
    public function index($query = null) {
        $widgets = $this->repository->allOrSearch($query);

        $no = $widgets->firstItem();

        return $this->view('widgets.index', compact('widgets', 'no'));
    }

    /**
     * Search in all articles.
     *
     * @return Response
     */
    public function search() {
        return $this->index(Input::get());
    }

    /**
     * Show the form for creating a new widgets.
     *
     * @return Response
     */
    public function create() {
        $widgetPositionController = new WidgetPositionController();
        $widgetPositions = $widgetPositionController->getAll();
    
        $menuArray = array();
       
        $menuController = new MenuController();
        $menus = $menuController->getAllMenuNames();
        foreach ($menus as $key => $menu) {
            $menuArray[$key] = $menu;
        }

        $widgetArray = array('Select Position');
        foreach ($widgetPositions as $widgetPosition) {
            $widgetArray[$widgetPosition->id] = $widgetPosition->position;
        }
        $arrays = array('widgetArray' => $widgetArray, 'menuArray' => $menuArray);
        
        //getting the list of categories to show on the form
        $adminCategoryController = new AdminCategoriesController(app('Pingpong\Admin\Repositories\Categories\CategoryRepository'));
        $categories = $adminCategoryController->getAllCategoryNames();
        $categories['0']="Uncategorized";
         
        //To  set the internal array pointer to first element so that it can be selected in UI automatically
        reset($categories);
        
        return $this->view('widgets.create', compact('arrays','categories'));
    }

    /**
     * Display the specified widget.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id) {
        try {
            $widgets = $this->repository->findById($id);

            return $this->view('widgets.show', compact('widgets'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Store a newly created widget in storage.
     *
     * @return Response
     */
    public function store(WidgetCreate $request) {
    	
        $data = $request->all();	
       
        $device = implode(" ", $data['device']);
        $data['device'] = $device;
        
        if(isset($data['description']))
        {
        	$data['description'] = htmlentities($data['description']);
        }
        
        if(!isset($data['module'])){
        	$data['module'] = 'custom';
        }else{
        	$params = array();
        	$params['count'] = $data['count'];
	        if($data['categories']['0'] == "0"){
	        	unset($data['categories']['0']);
	        }
        	$params['categories'] = $data['categories'];
        	$params['orderBy'] = $data['orderBy'];
        	$params['startDate'] = $data['startDate'];
        	$params['endDate'] = $data['endDate'];
        	 
        	$paramsString = json_encode($params);
        	
        	$data['params'] = $paramsString;
        }
        $data['user_id'] = \Auth::id();
        $widgetData = $this->repository->create($data);
        $widgetID = $widgetData->id;
        $menu = (isset($data['menu']) ? $data['menu'] : '0');
        $menuController = new MenuController();
        $widgetMenuController = new WidgetMenusController();
        foreach ($menu as $index => $id) {
        	//getting all child menus if it's a parent menu
        	$childMenus = $widgetMenuController->repository->getAllChildMenus($id);
        	foreach ($childMenus as $childMenuObj){
        		$widgetMenuController->linkMenuWithWidget($widgetID, $childMenuObj->id);
        	}
            $widgetMenuController->linkMenuWithWidget($widgetID, $id);
        }
        return $this->redirect('widgets.index');
    }

    /**
     * Show the form for editing the specified widget.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id) {
        try {
            $widget = $this->repository->findById($id);

            $device = explode(" ", $widget->device);
            $widget->device = $device;
            $widgetPositionController = new WidgetPositionController();
            $widgetPositions = $widgetPositionController->getAll();

            $widgetArray = array('Select Position');
            foreach ($widgetPositions as $widgetPosition) {
                $widgetArray[$widgetPosition->id] = $widgetPosition->position;
            }

            $menuArray = array('Select Parent Menu');
            $menuController = new MenuController();
            $menus = $menuController->getAllMenuNames();
            foreach ($menus as $index => $title) {
                $menuArray[$index] = $title;
            }
            $widgetMenu = new WidgetMenusController();
            $selectedMenus = $widgetMenu->getAllMenus($id);
            $widget['menu'] = $selectedMenus;
            $arrays = array('widgetArray' => $widgetArray, 'menuArray' => $menuArray);
            
            if($widget['module'] != 'custom'){
            
            	$templateFiles = glob("../resources/views/templates/".option('site.template')."/module/*.blade.php");
            	$templates = array();
            	 
            	foreach ($templateFiles as $index => $filename) {
            		$templates[substr(basename($filename), 0, strpos(basename($filename), ".blade.php"))]  = ucfirst(substr(basename($filename), 0, strpos(basename($filename), ".blade.php")));
            	}
            	try{
            		unset($templates['custom']);
            		unset($templates['noncustom']);
            		unset($templates['custom']);
            		unset($templates['noncustom']);
            		unset($templates['menus']);
            		unset($templates['rightsidegallery']);
            		unset($templates['rightvideo']);
            		unset($templates['video']);
            	}catch (\Exception $e){
            		// let it pass, no need to worry
            	}
            	
            	$adminCategoryController = new AdminCategoriesController(app('Pingpong\Admin\Repositories\Categories\CategoryRepository'));
            	$categories = $adminCategoryController->getAllCategoryNames();
            	if(isset($categories['0'])){
            		$categories['0']="Uncategorized";
            	}
            	
            	$params = json_decode($widget['params'],true);
            	
            	unset($widget['params']);
            	
            	foreach ($params as $key => $value){
            		$widget->$key = $value;
            	}    	
            }

            return $this->view('widgets.edit', compact('widget'), compact('arrays','module','templates','categories'));

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified widget in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(WidgetUpdate $request, $id) {
        try {

            $widget = $this->repository->findById($id);
            $data = $request->all();
           
            if(!isset($data['show_title'])){
            	$data['show_title'] = 0;
            }
            
            if(!isset($data['show_popup'])){
            	$data['show_popup'] = 0;
            }
            
            if(isset($data['description']))
            {
            	$data['description'] = htmlentities($data['description']);
            }
            
            if(!isset($data['module'])){
            	$data['module'] = 'custom';
            }else{
            	$params = array();
            	$params['count'] = $data['count'];
            	
            	if($data['categories']['0'] == "0"){
            		unset($data['categories']['0']);
            	}
            	$params['categories'] = $data['categories'];
            	$params['orderBy'] = $data['orderBy'];
            	$params['startDate'] = $data['startDate'];
            	$params['endDate'] = $data['endDate'];
            
            	$paramsString = json_encode($params);
            	 
            	$data['params'] = $paramsString;
            }
            
            if(isset($data['device']))
            {
            	$device = implode(" ", $data['device']);
            	$data['device'] = $device;
            }else{
            	$data['device'] = "";
            }
            $widget->update($data);

            $menu = (isset($data['menu']) ? $data['menu'] : '0');
            
            $menuController = new MenuController();
            $widgetMenuController = new WidgetMenusController();
            
            $widgetMenuController->removeAllMenus($id);
            
            
            foreach ($menu as $index => $menuid) {
            	//getting all child menus if it's a parent menu
            	$childMenus = $widgetMenuController->repository->getAllChildMenus($id);
            	foreach ($childMenus as $childMenuObj){
            		$widgetMenuController->linkMenuWithWidget($widgetID, $childMenuObj->id);
            	}
                 $widgetMenuController->linkMenuWithWidget($id, $menuid);
            }

            return $this->redirect('widgets.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified widget from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id) {
        try {
            $this->repository->delete($id);

            return $this->redirect('widgets.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
    
    /**
     * Show all the list of widget types to choose from
     *
     * @return Response
     */
    public function chooseWidgetType(){
    	return $this->view('widgets.choose');
    }
    
    /**
     * Show the form for predefined widget category.
     *
     * @return Response
     */
    public function preDefinedWidget(){
    	$widgetPositionController = new WidgetPositionController();
    	$widgetPositions = $widgetPositionController->getAll();
    	$menuArray = array();
    	
    	$menuController = new MenuController();
    	$menus = $menuController->getAllMenuNames();
    	foreach ($menus as $key => $menu) {
    		$menuArray[$key] = $menu;
    	}
    	
    	$widgetArray = array('Select Position');
    	foreach ($widgetPositions as $widgetPosition) {
    		$widgetArray[$widgetPosition->id] = $widgetPosition->position;
    	}
    	$arrays = array('widgetArray' => $widgetArray, 'menuArray' => $menuArray );
    	$module = 'articleCategory';
    	$templateFiles = glob("../resources/views/templates/".option('site.template')."/module/*.blade.php");
		$templates = array();
    	
    	foreach ($templateFiles as $index => $filename) {
    		$templates[substr(basename($filename), 0, strpos(basename($filename), ".blade.php"))]  = ucfirst(substr(basename($filename), 0, strpos(basename($filename), ".blade.php")));
    	}
   		try{
           	unset($templates['custom']);
            unset($templates['noncustom']);
            unset($templates['custom']);
            unset($templates['noncustom']);
            unset($templates['menus']);
            unset($templates['rightsidegallery']);
            unset($templates['rightvideo']);
            unset($templates['video']);
            unset($templates['widget']);
        }catch (\Exception $e){
           	// let it pass, no need to worry
        }

    	$adminCategoryController = new AdminCategoriesController(app('Pingpong\Admin\Repositories\Categories\CategoryRepository'));
    	$categories = $adminCategoryController->getAllCategoryNames();
    	$categories['0']="Uncategorized";
    	
    	//To  set the internal array pointer to first element so that it can be selected in UI automatically
    	reset($categories);
    	return $this->view('widgets.create', compact('arrays','module','templates','categories'));
    }

}
