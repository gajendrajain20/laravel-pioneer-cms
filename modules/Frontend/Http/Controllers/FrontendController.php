<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Http\Controllers\BaseController;
use App\Http\Requests\Request;
use Modules\Admin\Http\Controllers\MenuController;
use Modules\Admin\Http\Controllers\AdminArticlesController;
use Pingpong\Admin\Uploader\ImageUploader;

class FrontendController extends BaseController {
	
// 	private $theme = "frontend";
	
// 	function __construct(){
// 		parent::__construct();
// 		$this->theme = (option('site.template')!='')?option('site.template'):"frontend";
// 	}
	
    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Pingpong\Admin\Repositories\Articles\ArticleRepository';
        return app($repository);
    }
    
    /**
     * Get Category repository instance.
     *
     * @return mixed
     */
    public function getCategoryRepository() {
        $repository = 'Pingpong\Admin\Repositories\Categories\CategoryRepository';
        return app($repository);
    }
    
    /**
     * Get Category repository instance.
     *
     * @return mixed
     */
    public function getArticleCategoryRepository() {
    	$repository = 'Modules\Admin\Repositories\ArticleCategory\ArticleCategoryRepository';
    	return app($repository);
    }
    
    /**
     * Get Page repository instance.
     *
     * @return mixed
     */
    public function getPageRepository() {
    	$repository = 'Pingpong\Admin\Repositories\Pages\PageRepository';
    	return app($repository);
    }
    
    /**
     * Get Video repository instance.
     *
     * @return mixed
     */
    public function getVideoRepository() {
        $repository = 'Modules\Admin\Repositories\Video\VideoRepository';
        return app($repository);
    }
    
    /**
     * Get Widgets repository instance.
     *
     * @return mixed
     */
    public function getWidgetsRepository() {
        $repository = 'Modules\Admin\Repositories\Widget\WidgetRepository';
        return app($repository);
    }
    
    /**
     * Get Menu repository instance.
     *
     * @return mixed
     */
    public function getMenuRepository() {
        $repository = 'Modules\Admin\Repositories\Menu\MenuRepository';
        return app($repository);
    }
    
    /**
     * index action
     *
     * @return mixed
     */
    public function index() {
        $query=array('status'=>'1','published_on'=>date('Y-m-d'),'type'=>'post');
        $limit=5;
        $page=1;
        $articles = $this->getRepository()->searchPost($query,$limit,$page)->toArray();
       
        return view($this->theme.'::frontend.index',compact('articles'));
    }

    /**
     * getTopBreakingNews action
     *
     * @return mixed
     */
    public function getTopBreakingNews() {
        $query=array('category_id'=>'13','status'=>'1','published_on'=>date('Y-m-d'),'type'=>'post');
        $limit=1;
        $page=10;
        $articles = $this->getRepository()->searchPost($query,$limit,$page)->toArray();
        return view($this->theme.'::module.topbreakingnews', compact('articles'));
    }
    
    /**
     * getVideo action
     *
     * @return mixed
     */
    public function getVideo() {
        $query=array('status'=>'1','published_on'=>date('Y-m-d'));
        $limit=5;
        $page=10;
        $articles = $this->getVideoRepository()->searchPost($query,$limit,$page)->toArray();
        return view($this->theme.'::module.video', compact('articles','url'));
    }
    
    /**
     * getVideo action
     *
     * @return mixed
     */
    public function getRightVideoNews() {
        $query=array('status'=>'1','published_on'=>date('Y-m-d'));
        $limit = 4;
        $page=10;
        $articles = $this->getVideoRepository()->searchPost($query,$limit,$page)->toArray();
        return view($this->theme.'::module.rightvideo', compact('articles','url'));
    }
    
    /**
     * getDoNotMissNews action
     *
     * @return mixed
     */
    public function getDoNotMissNews() {
        $query=array('category_id'=>'6','status'=>'1','published_on'=>date('Y-m-d'),'type'=>'post');
        $limit=3;
        $page=10;
        $articles = $this->getRepository()->searchPost($query,$limit,$page)->toArray();
        return view($this->theme.'::module.donotmiss', compact('articles'));
    }
    
    /**
     * getRightSideNews action
     *
     * @return mixed
     */
    public function getRightSideNews($category_id, $color,$limit=5) {
        $category = $this->getCategoryRepository()->findById($category_id)->toArray();
        $categoryName=$category['name'];
        $query=array('status'=>'1','published_on'=>date('Y-m-d'),'type'=>'post');
        $query['category_id']=$category_id;
        $page=10;
        $articles = $this->getRepository()->searchPost($query,$limit,$page)->toArray();
        return view($this->theme.'::module.rightside', compact('articles','categoryName','category_id','color'));
    }
    
    /**
     * getRightSideGalleryNews action
     *
     * @return mixed
     */
    public function getRightSideGalleryNews($category_id, $color,$limit=5) {
        $category = $this->getCategoryRepository()->findById($category_id)->toArray();
        $categoryName = $category['name'];
        $query = array('status' => '1', 'published_on' => date('Y-m-d'), 'type' => 'post');
        $query['category_id'] = $category_id;
        $page = 10;
        $articles = $this->getRepository()->searchPost($query, $limit, $page)->toArray();
        return view($this->theme.'::module.rightsidegallery', compact('articles', 'categoryName', 'category_id', 'color'));
    }
    /**
     * homeBottom action
     *
     * @return mixed
     */
    public function homeBottom($category_id,$color) {
        $category = $this->getCategoryRepository()->findById($category_id)->toArray();
        
        $categoryName=$category['name'];
        $query=array('status'=>'1','published_on'=>date('Y-m-d'),'type'=>'post');
        $query['category_id']=$category_id;
        $limit=3;
        $page=10;
        $articles = $this->getRepository()->searchPost($query,$limit,$page)->toArray();
        return view($this->theme.'::module.homebottom', compact('articles','categoryName','category_id','color'));
    }
       
    /**
     * getNewsGallery action
     *
     * @return mixed
     */
    public function getNewsGallery() {
        $query=array('category_id'=>'11','status'=>'1','published_on'=>date('Y-m-d'),'type'=>'post');
        $limit=3;
        $page=10;
        $articles = $this->getRepository()->searchPost($query,$limit,$page)->toArray();
        $category_id =11;
        return view($this->theme.'::module.newsgallery', compact('articles','category_id'));
    }
    
    /**
     * getMayLikeNews action
     *
     * @return mixed
     */
    public function getMayLikeNews($category) {
        $query = array('category_id' => $category, 'status' => '1', 'published_on' => date('Y-m-d'), 'type' => 'post');
        $limit = 3;
        $page = 10;
        $articles = $this->getRepository()->searchPost($query, $limit, $page)->toArray();
        return view($this->theme.'::module.maylike', compact('articles'));
    }
    /**
     * getGossipNews action
     *
     * @return mixed
     */
    public function getGossipNews() {
        $query=array('category_id'=>'9','status'=>'1','published_on'=>date('Y-m-d'),'type'=>'post');
        $limit=3;
        $page=10;
        $articles = $this->getRepository()->searchPost($query,$limit,$page)->toArray();
        return view($this->theme.'::module.gossip', compact('articles'));
    }
    
    /**
     * Getting the list of all menus
     *
     * @return mixed
     */
    public function getAllMenus() {
        $menus = $this->getMenuRepository()->getAllMenuNames()->toArray();
        $menuArray = $this->buildTree($menus);
        
        return view($this->theme.'::module.menus', compact('menuArray'));
    }
    
      
    /**
     * Creating  View from given template
     *
     * @params string view
     * 
     * @params array data
     *
     * @return View
     */
    public function createView($view,$data) {
    	$articles = $data;
    	return view($this->theme.'::module.'.$view, compact('articles'));
    }
    
    
    /**
     * Getting all non custom widgets for a specified position & menu
     *
     * @params string position
     * 
     * @params int menuID
     *
     * @return View
     */
 public function getAllWidgets($position, $menu_id = '') {
    	$path = \Request::path();
    
    	$menuController = new MenuController();
    	$menuData = array_filter($menuController->findUsingUrl($path));
    	
    	if(!empty($menuData)){
    		$menuData = $menuData['0'];
    		$menu_id = $menuData['id'];
    	}
    	if($path=='/'){
    		$menu_id=1;
    	}
    	
    	//showing widgets on article page based on the menu of category of article.
    	$segments = explode('/', $path);
    	$pathType = $segments['0'];
    
    	if($pathType == 'article'){
    		$widgetArray = array();
    		$articleID = $segments['1'];
    		//getting all categories under which this article falls.
    		$articleCategories = $this->getArticleCategoryRepository()->getAllcategories($articleID);
    		
    		foreach ($articleCategories as $articleCategory){
    			$menuPath = 'category/'.$articleCategory;
    			
    			$menuData = array_filter($menuController->findUsingUrl($menuPath));
    			
    			if(!empty($menuData)){
    				$menu_id = $menuData['0']['id'];
    				
    				$query=array('menu_id'=>$menu_id,'position'=>$position);
    				
    				//getting the ids of all the non custom modules
    				$data = $this->getWidgetsRepository()->searchWidgets($query)->toArray();
    				$widgetArray =array_merge($widgetArray, $data);
    			}
    			
    		}
    		$widgets = array_unique($widgetArray, SORT_NUMERIC );
    		
    	}else{
    		$query=array('menu_id'=>$menu_id,'position'=>$position);
    		//getting the ids of all the non custom modules
    		$widgets = $this->getWidgetsRepository()->searchWidgets($query)->toArray();    		
    	}
    	
    	$artilesController = new AdminArticlesController(new ImageUploader());
    	//Getting default modules (i.e. Widgets assigned to All Menus)
    	$query = array('menu_id' => 0, 'position' => $position);
    	$widgets = array_merge($widgets, $this->getWidgetsRepository()->searchWidgets($query)->toArray());
    	$widgetsData = array();
		
    	foreach($widgets as $index => $widget){
    		//applying no of days limit to the widgets
    		$widgetData = array();
    		$now = time();
    		$createdDate = $widget['created_at'];
    		$datediff = $now - $createdDate;
    		$diff =  floor($datediff / (60 * 60 * 24));
    		
    		if($widget['days_count'] == 0 || $widget['days_count']< $diff){
    			
    			if($widget['show_title'] == 1){
    				$widgetData[$index]['title'] = $widget['title'];
    			}
    			 
    			if($widget['device'] !=null || trim($widget['device']) != ""){
    				if($widget['class'] != null || $widget['class'] != "" ){
    					$widgetData[$index]['class'] = $widget['class']." ".$widget['device'];
    				}else{
    					$widgetData[$index]['class'] =$widget['device'];
    				}
    			}else{
    				$widgetData[$index]['class'] = $widget['class']." widget";
    			}
    			
	    		if($widget['module'] != 'custom'){
	    			$params = json_decode($widget['params'],true);
	    			
	    			$searchQuery = array();
	    			foreach ($params as $key => $param){
	    				$searchQuery[$key] = $param;
	    			}
	    			$filteredQuery = array_filter($searchQuery);
	    		
	    			//reset keys
	    			$widgetData = array_values($widgetData);
	    			$widgetData = $widgetData['0'];
	    			
	    			//checking if there is a single category or not, & if there is only one then show see all button in view
	    			if(count($searchQuery['categories']) == 1){
	    				$widgetData['seeAll'] = $searchQuery['categories']['0'];
	    			}
	    			
	    			$widgetsData[$widget['widget_id']] =array('module'=>$widget['module'],'widgetData'=>$widgetData,
	    					'ncData' => $artilesController->customSearchForArticles($filteredQuery)->toArray());
	    		}else{
	    			$widgetData[$index]['show_popup'] = $widget['show_popup'];
	    			$widgetData[$index]['description'] = $widget['description'];
	    			$widgetsData[$index] =array('module'=>$widget['module'], 'widgetData'=>null, 'ncData' => $widgetData);
	    		}
    		}
    	}
    		return view($this->theme.'::module.noncustom', compact('widgetsData'));
    	
    }
    
    /**
     * Building hierarichal array structure for menus
     *
     * @params Array data
     *
     * @params int parent
     *
     * @return Array
     */
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
}
