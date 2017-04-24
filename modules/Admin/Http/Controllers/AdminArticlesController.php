<?php

namespace Modules\Admin\Http\Controllers;

use Pingpong\Admin\Controllers\ArticlesController;
use Pingpong\Admin\Validation\Article\Create;
use Pingpong\Admin\Validation\Article\Update;
use Modules\Admin\Validation\Article\AdminCreate;
use Modules\Admin\Validation\Article\AdminUpdate;
use Modules\Admin\Http\Controllers\TagsController;
use Modules\Admin\Http\Controllers\ArticleTagsController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

class AdminArticlesController extends ArticlesController {

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        if (isOnPages()) {
            $repository = 'Pingpong\Admin\Repositories\Pages\PageRepository';
        } else {
            $repository = 'Pingpong\Admin\Repositories\Articles\ArticleRepository';
        }

        return app($repository);
    }
    
    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getUserRepository() {
        $repository = 'Pingpong\Admin\Repositories\Users\UserRepository';
        return app($repository);
    }
    /**
     * Display a listing of articles.
     *
     * @return Response
     */
    public function index($query = null) {
    	   	
    	if($query != null){
    		$selectedMonthString = $query['month_list'];
    		$time = strtotime($selectedMonthString);
    		$formattedSelectedMonth=date('F', $time);
    		$formattedSelectedYear=date('Y', $time);
    		$query['month_list_month']= $formattedSelectedMonth;
    		$query['month_list_year']= $formattedSelectedYear;
    		
    	}
    	$user = \Auth::user();
		$user_id = Input::get('user_id');
        $articles = $this->repository->allOrSearch($query, $user_id);
        $users_list=array();
	        $users = $this->repository->getAllUserNames();
	        $users_list['0'] = 'All Users';
	        foreach($users as $user){
	            $users_list[$user['id']] = $user['name'];
	        }
	    $refinedMonthList = array();
	    if(isOnPages()){
	    	$month_list = $this->repository->getPagesMonthList();
	    }else{
	    	$month_list = $this->repository->getArticlesMonthList();
	    }
	    foreach($month_list as $i => $month){
	    	$refinedMonthList[$month->dates] = $month->dates;
	    }
    	$no = $articles->firstItem();
    	$categoryController = new AdminCategoriesController(app('Pingpong\Admin\Repositories\Categories\CategoryRepository'));
    	$categories = $categoryController->getAllCategoryNames();
    	$categories_list = array();
    	$categories_list['0']= 'All Categories' ;
    	foreach($categories as $id => $title){
    		$categories_list[$id]= $title ;
    	}
    	$articles->categories_list = $categories_list;
        $articles->users_list = $users_list;
        $articles->month_list = array('-1'=>'All Dates')+ $refinedMonthList;
    	return $this->view('articles.index', compact('articles', 'no'));
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
     * Search in all articles.
     *
     * @return Response
     */
    public function searchDraft() {
    	return $this->draftsList(Input::get());
    }
    

    /**
     * Display a listing of articles.
     *
     * @return Response
     */
    public function draftsList($query = null) {
        $user = \Auth::user();
        if($query != null){
        	$selectedMonthString = $query['month_list'];
        	$time = strtotime($selectedMonthString);
        	$formattedSelectedMonth=date('F', $time);
        	$formattedSelectedYear=date('Y', $time);
        	$query['month_list_month']= $formattedSelectedMonth;
        	$query['month_list_year']= $formattedSelectedYear;
        
        }
        $user_id = Input::get('user_id');
        if($query == null){
        	$articles = $this->repository->findBy('status', '0', '=');
        }else{
        	$articles = $this->repository->allOrSearch($query, $user_id);
        }  
        $users_list=array();
        $users = $this->repository->getAllUserNames();
        $users_list['0'] = 'All Users';
        foreach($users as $user){
        	$users_list[$user['id']] = $user['name'];
        }
        $refinedMonthList = array();
        $month_list = $this->repository->getArticlesMonthList();
        foreach($month_list as $i => $month){
        	$refinedMonthList[$i] = $month->dates;
        }
        $no = $articles->firstItem();
        $categoryController = new AdminCategoriesController(app('Pingpong\Admin\Repositories\Categories\CategoryRepository'));
        $categories = $categoryController->getAllCategoryNames();
        $categories_list = array();
        $categories_list['0']= 'All Categories' ;
        foreach($categories as $id => $title){
        	$categories_list[$id]= $title ;
        }
        $articles->categories_list = $categories_list;
        $articles->users_list = $users_list;
        $articles->month_list = array('-1'=>'All Dates')+ $refinedMonthList;
        
        return $this->view('articles.drafts', compact('articles', 'no'));
    }

    /**
     * Returns a listing of articles.
     *
     * @return array
     */
    public function getAllArticleNames() {
    	return $this->repository->getAllArticleNames();
    }
    /**
     * Returns a listing of articles.
     *
     * @return Elequent Object
     */
    public function getAllArticleNamesModel() {
    	return $this->repository->getAllArticleNamesModel();
    }
    /**
     * Returns a listing of pages.
     *
     * @return array
     */
    public function getAllPageNames() {
    	return $this->repository->getAllPageNames();
    }
    /**
     * Returns a listing of pages.
     *
     * @return Elequent Object
     */
    public function getAllPageNamesModel() {
    	return $this->repository->getAllPageNamesModel();
    }
    
    /**
     * Finds an article/page from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function findById($id) {
    	return $this->repository->findById($id);
    }
    
    /**
     * Finds  articles/page from storage using custom queries for modules.
     *
     * @param string searchQuery
     *
     * @return Response
     */
    public function customSearchForArticles($searchQuery) {
    	return $this->repository->customSearchForArticles($searchQuery);
    }
    
    /**
     * Store a newly created article in storage.
     *
     * @return Response
     */
    public function adminStore(AdminCreate $request) {
        $data = $request->all();
        
        $data['published_on'] = date('Y-m-d', strtotime($data['published_on']));
                
        $data['user_id'] = \Auth::id();
        $data['slug'] = Str::slug($data['title']);
        $postData = $this->repository->create($data);
        $postID = $postData->id;
        
        if(!isset($data['show_featured_image'])){
            $data['show_featured_image']=0;
        }

        if(isset($data['category_id'])){
	        $articleCategory = new ArticleCategoryController();
	        foreach($data['category_id'] as $categoryID){
	        	$articleCategory->linkCategoryWithArticle($postID, $categoryID);
	        }
        }
        if (!isOnPages()) {
            $tags = explode(',', $data['tags']);
            $tags = array_filter($tags);

            if (!empty($tags)) {
                $tagController = new TagsController();
                $articleTagController = new ArticleTagsController;
                //Link all the tags with the post
                foreach ($tags as $tag) {
                    $row = $tagController->addTag($tag);
                    $tagID = $row['id'];
                    $articleTagController->linkTagWithPost($postID, $tagID, 'post');
                }
            }
        }
        return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index');
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id) {
        try {
            $user = \Auth::user();
            $user_id = 0;
            if (!$user->is('admin')) {
                $user_id = $user->id;
            }
            //$article = $this->repository->findById($id, $user_id);
            $article = $this->repository->findBySlug($id, $user_id);
           
            if (!isset($article)) {
                return $this->redirectNotFound();
            }
            $id = $article->id;
            if (!isOnPages()) {
                $tagController = new TagsController();
                $articleTagController = new ArticleTagsController;
                $tagIDs = $articleTagController->getAllTags($id, 'post');

                $tagIDs = array_filter($tagIDs);
                if (!empty($tagIDs)) {
                    foreach ($tagIDs as $tagID) {
                        $tag = $tagController->findById($tagID)['tag'];
                        $tags[] = $tag;
                    }
                    $_tags = implode(',', $tags);
                    $article['tags'] = $_tags;
                }
                $articleCategory = new ArticleCategoryController();
                $categories = $articleCategory->getAllcategories($id);
  				$article['category_id'] = $categories;
            }
            return $this->view('articles.edit', compact('article'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified article in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function adminUpdate(AdminUpdate $request, $id) {
        try {
            $article = $this->repository->findById($id);

            $data = $request->all();
            
            if(!isset($data['show_featured_image'])){
                $data['show_featured_image']=0;
            }            
            $data['published_on'] = date('Y-m-d', strtotime($data['published_on']));
		                 
            unset($data['type']);

            $data['user_id'] = \Auth::id();
            $data['slug'] = Str::slug($data['title']);

            $articleCategory = new ArticleCategoryController();
            if(isset($data['category_id'])){
                $articleCategory->removeAllcategories($id);
            	foreach($data['category_id'] as $categoryID){
            		$articleCategory->linkCategoryWithArticle($id, $categoryID);
            	}
            }else{	
            	$articleCategory->removeAllcategories($id);
            }
            if (!isOnPages()) {
                $tags = explode(',', $data['tags']);
                $tags = array_filter($tags);
                $articleTagController = new ArticleTagsController;
                
                if (!empty($tags)) {
                    $tagController = new TagsController();
                    $articleTagController = new ArticleTagsController;
                    $articleTagController->removeAllTag($id, 'post');

                    //Link all the tags with the post
                    foreach ($tags as $tag) {
                        $row = $tagController->addTag($tag);
                        $tagID = $row['id'];
                        $articleTagController->linkTagWithPost($id, $tagID, 'post');
                    }
                } else {
                    $articleTagController->removeAllTag($id, 'post');
                }
            }
            $article->update($data);

            return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
    
    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        if(isOnPages()){
            return $this->redirect('pages.index')
            ->withFlashMessage('Page not found!')
            ->withFlashType('danger');
        }else{
            return $this->redirect('articles.index')
            ->withFlashMessage('Article not found!')
            ->withFlashType('danger');
        }
    }

}
