<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Controllers\BaseController;
use Modules\Admin\Validation\Menu\MenuCreate;
use Modules\Admin\Validation\Menu\MenuUpdate;
use Illuminate\Support\Str;
use Modules\Admin\Http\Controllers\MenuTypeController;
use Pingpong\Admin\Uploader\ImageUploader;

class MenuController extends BaseController {

    protected $menus;

    /**
     * @var ImageUploader
     */
    protected $uploader;

    /**
     * @param ImageUploader $uploader
     */
    public function __construct() {
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\Menu\MenuRepository';
        return app($repository);
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound() {
        return $this->redirect(isOnPages() ? 'pages.index' : 'menus.index')
                        ->withFlashMessage('Post not found!')
                        ->withFlashType('danger');
    }

    /**
     * Display a listing of menus.
     *
     * @return Response
     */
    public function index() {

        $menus = $this->repository->allOrSearch(Input::get('q'));
        $no = $menus->firstItem();

        return $this->view('menus.index', compact('menus', 'no'));
    }

    public function buildTree(Array $data, $parent = 0) {
        $tree = array();
        foreach ($data as $d) {
            if ($d['parent'] == $parent) {
                $children = $this->buildTree($data, $d['id']);
                // set a trivial key
                if (!empty($children)) {
                    $d['_children'] = $children;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }

    public function createHierarchy($tree, $temp, $r = 0, $p = null) {
        foreach ($tree as $i => $t) {
            $dash = ($t['parent'] == 0) ? '' : str_repeat('-', $r) . ' ';
            $temp[$t['id']] = $dash . $t['title'];
            if ($t['parent'] == 0) {
                // reset $r
                $r = 0;
            }
            if (isset($t['_children'])) {
                $temp = $this->createHierarchy($t['_children'], $temp, ++$r, $t['parent']);
            }
        }
        return $temp;
    }

    /**
     * Returns a listing of menus.
     *
     * @return array
     */
    public function getAllMenuNames() {

        $menus = $this->repository->getAllMenuNames()->toArray();
        $menuArray = $this->buildTree($menus);
        $newArray = $this->createHierarchy($menuArray, $temp = array());
        $newArray = array('0' => 'All Menus') + $newArray;

        return $newArray;
    }

    /**
     * Show the form for creating a new menu.
     *
     * @return Response
     */
    public function create() {
        $menuTypeController = new MenuTypeController();
        $menuTypes = $menuTypeController->getAll();

        $menuTypeArray = array('Select Menu Position');
        foreach ($menuTypes as $menuType) {
            $menuTypeArray[$menuType->id] = $menuType->name;
        }

        $menus = $this->getAllMenuNames(); //Array of hierarichal menus

        $menu_model = array();
        $menu_model['elements'] = array();
        $menu_model['menuTypeArray'] = $menuTypeArray;
        $menu_model['menuArray'] = $menus;
        return $this->view('menus.create', compact('menu_model'));
    }

    /**
     * Store a newly created menu in storage.
     *
     * @return Response
     */
    public function store(MenuCreate $request) {
        $data = $request->all();

        $data['user_id'] = \Auth::id();
        $data['slug'] = Str::slug($data['title']);
        if ($data['type'] == "custom") {
            $data['post_id'] = '0';
        }

        if ($data['type'] == 'category') {
            $data['url'] = 'category/' . $data['post_id'];
        } else if ($data['type'] == 'post') {
            $data['url'] = 'article/' . $data['post_id'];
        } else if ($data['type'] == 'video') {
            $data['url'] = 'video/' . $data['post_id'];
        } else if ($data['type'] == 'page') {
            $data['url'] = 'page/' . $data['post_id'];
        }	else if ($data['type'] == 'module') {
            $data['url'] = $data['post_id'];
        }
        $this->repository->create($data);

        return $this->redirect('menus.index');
    }

    /**
     * Display the specified menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id) {
        try {
            $menus = $this->repository->findById($id);

            return $this->view('menus.show', compact('menus'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id) {
        try {
            $dataArray = array();
            $menus = $this->repository->findById($id);

            $menuTypeController = new MenuTypeController();
            $menuTypes = $menuTypeController->getAll();

            $menuTypeArray = array('Select Menu Position');
            foreach ($menuTypes as $menuType) {
                $menuTypeArray[$menuType->id] = $menuType->name;
            }
            $menuArray = array('Select Parent Menu');
            $allMenus = $this->getAllMenuNames();
            foreach ($allMenus as $key => $value) {
                if ($id != $key) {
                    $menuArray[$key] = $value;
                }
            }
            $menu_model = array();
            
            if ($menus->post_id != null) {
                $type = $menus->type;
                switch ($type) {
                    case 'category':
                        $categoryController = new AdminCategoriesController(app('Pingpong\Admin\Repositories\Categories\CategoryRepository'));
                        $dataArray = $categoryController->getAllCategoryNamesModel()->toArray();
                        break;
                        
                    case 'post':
                        $articleController = new AdminArticlesController(new ImageUploader());
                        $dataArray = $articleController->getAllArticleNamesModel()->toArray();
                        break;
                        
                    case 'page':
                        $articleController = new AdminArticlesController(new ImageUploader());
                        $dataArray = $articleController->getAllPageNamesModel()->toArray();
                        break;
                        
                    case 'video':
                        $videoController = new VideosController(new ImageUploader());
                        $dataArray = $videoController->getAllVideoNamesModel()->toArray();
                        break;
                       
                }
            }
            
            if($menus->type == 'module'){
            	$moduleController = new ModulesController();
            	$dataArray = $moduleController->getAllModulesNames();
            }
            
            $menu_model['elements'] = array();
            foreach ($dataArray as $data) {
                $menu_model['elements'][$data['id']] = $data['title'];
            }
            $menu_model['menuTypeArray'] = $menuTypeArray;
            $menu_model['menuArray'] = $menuArray;
            
            return $this->view('menus.edit', compact('menus'), compact('menu_model'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified menu in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(MenuUpdate $request, $id) {
        try {
            $menu = $this->repository->findById($id);

            $data = $request->all();
            // unset($data['type']);

            $data['user_id'] = \Auth::id();
            $data['slug'] = Str::slug($data['title']);

            if ($data['type'] == 'category') {
                $data['url'] = 'category/' . $data['post_id'];
            } else if ($data['type'] == 'post') {
                $data['url'] = 'article/' . $data['post_id'];
            } else if ($data['type'] == 'video') {
                $data['url'] = 'video/' . $data['post_id'];
            } else if ($data['type'] == 'page') {
                $data['url'] = 'page/' . $data['post_id'];
            } else if ($data['type'] == 'module') {
            $data['url'] = 'route(' . $data['post_id'].')';
       		}

            $menu->update($data);

            return $this->redirect('menus.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Finds wheter the given category is a parent menu or not
     *
     * @return Elequent object
     */
    public function findWheterAParentMenu($id) {
        return $this->repository->findWheterAParentMenu($id);
    }
    
    /**
     * Finds wheter the given category is a parent menu or not
     *
     * @return Elequent object
     */
    public function findUsingUrl($path) {
    	return $this->repository->findUsingUrl($path);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id) {
        $parent = $this->findWheterAParentMenu($id);
        if (isset($parent['0']['id'])) {
            $errors = array("menu" => "It is a parent Menu of " . $parent['0']['title'] . ".  So please delete it's child Menu(s) first to remove it");
            return $this->redirect('menus.index')->withErrors($errors);
        } else {
            try {
                $this->repository->delete($id);

                return $this->redirect('menus.index');
            } catch (ModelNotFoundException $e) {
                return $this->redirectNotFound();
            }
        }
    }

}
