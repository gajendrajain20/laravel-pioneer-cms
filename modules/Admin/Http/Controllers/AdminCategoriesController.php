<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Entities\Category;
use Pingpong\Admin\Controllers\CategoriesController;
use Pingpong\Admin\Repositories\Categories\CategoryRepository;
use Pingpong\Admin\Validation\Category\Create;
use Pingpong\Admin\Uploader\ImageUploader;

/**
 * Description of AdminCategoriesController
 *
 * @author admin
 */
class AdminCategoriesController extends CategoriesController {
    
    /**
     * This property is used to hold the repository object for tihs controller
     * 
     * @var string
     */
	protected $repository;
	
	public function __construct(CategoryRepository $repository)
	{
		$this->repository = $repository;
	}

    /**
     * Show the form for creating a new category.
     *
     * @return Response
     */
    public function create() {
        $parent = 0;
        $categoryArray = array('0'=> 'Select Parent');
        $categories = $this->getAllCategoryNames();
        foreach ($categories as $id => $title) {
            $categoryArray[$id] = $title;
        }

        return $this->view('categories.create', compact('categoryArray'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id) {
        try {
            $categories = $this->getAllCategoryNames();
            $categoryArray = array('0' =>'Select Parent');
            foreach ($categories as $index => $title) {
                if (!($id == $index))
           		{
            	   	$categoryArray[$index] = $title;
            	}
            }
            $category = $this->repository->findById($id);
            return $this->view('categories.edit', compact('category'), compact('categoryArray'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Store a newly created category in storage.
     *
     * @return Response
     */
    public function store(Create $request) {
        $data = $request->all();

        $category = Category::create($data);

        return $this->redirect('categories.index');
    }
    
    /**
     * Returns a hierarichal listing  of catergories.
     *
     * @return array
     */
    public function buildTree(Array $data, $parent = 0) {
    	$tree = array();
    	foreach ($data as $_data) {
    		if ($_data['parent'] == $parent) {
    			$children = $this->buildTree($data, $_data['id']);
    			// set a trivial key
    			if (!empty($children)) {
    				$_data['_children'] = $children;
    				$_data['class'] = 'child';
    			}
    			$tree[] = $_data;
    		}
    	}
    	
    	return $tree;
    }
    
    /**
     * Returns a array of catergories.
     *
     * @return array
     */
    public function createHierarchy($tree, $tempTree, $depthLevel = 0, $parent = null) {
    	foreach ($tree as $index => $currentTree) {
    		$dash = ($currentTree['parent'] == 0) ? '' : str_repeat('-', $depthLevel) .' ';
    		$tempTree[$currentTree['id']] = $dash.$currentTree['title'];
    		if ($currentTree['parent'] == $parent) {
    			// reset $r
    			$depthLevel = 0;
    		}
    		if (isset($t['_children'])) {
    			$tempTree = $this->createHierarchy($currentTree['_children'],$tempTree, ++$depthLevel, $currentTree['parent']);
    		}
    	}
    	return $tempTree;
    }
    
    /**
     * Returns a listing of categories.
     *
     * @return array
     */
    public function getAllCategoryNames()
    {
    	$categories =  $this->repository->getAllCategoryNames();
    	$hierarichalArray = $this->buildTree($categories);
    	$newArray = $this->createHierarchy($hierarichalArray,$temp = array());
        $newArray = array('0' => 'Select Parent Category') + $newArray;
    	return $newArray;
    }
    
    /**
     * Returns a listing of categories in array of array.
     *
     * @return array
     */
    public function getAllCategoryNamesList()
    {   
    	$categories =  $this->repository->getAllCategoryNames();
    	$hierarichalArray = $this->buildTree($categories);
    	$newArray = $this->createHierarchy($hierarichalArray,$temp = array());
//     	$newArray = array('0' => 'Select Parent Category') + $newArray;
    	$result = array();
    	$index=0;
    	foreach($newArray as $key => $value){
    		$result[$index++]= array('id'=>$key,'title'=>$value);
    	}
    	return $result;
    }
    
    /**
     * Returns a hierarichal tree of categories
     *
     * @return array
     */
    public function getHierarichalCategoriesTree()
    {
    	$categories =  $this->repository->getAllCategoryNames();
    	$hierarichalArray = $this->buildTree($categories);
    	return $hierarichalArray;
    }
    /**
     * Returns a listing of categories.
     *
     * @return Elequent object
     */
    public function getAllCategoryNamesModel(){
    	return $this->repository->getAllCategoryNamesModel();
    }
    /**
     * Finds wheter the given category is a parent category or not
     *
     * @return Elequent object
     */
    public function findWheterAParentCategory($id){
    	return $this->repository->findWheterAParentCategory($id);
    }
    
    /**
     * Finds wheter the given category is assigned to a Post or not
     *
     * @params int $id
     *
     * @return Elequent object
     */
    public function findWheterAnAssignedCategory($id){
    	$articlesCategoryController = new ArticleCategoryController();
	
    	return  $articlesCategoryController->findByCategoryId($id);
    }
    
    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {	
    	$parent = $this->findWheterAParentCategory($id);
    	$assigned =  $this->findWheterAnAssignedCategory($id)->toArray();

    	if(isset($parent['0']['id'])){
    		$errors = array("category"=>"It is a parent category of ".$parent['0']['name'].".  So please delete it's child category first to remove it");
    		return $this->redirect('categories.index')->withErrors($errors);
    	}else{
    		if(isset($assigned['0']['id'])){
    			$articlesController = new AdminArticlesController(new ImageUploader());
    			$article = $articlesController->findById($assigned['0']['article_id'])->toArray();
    			
    			$errors = array("category"=>"This category is assigned to ".$article['title'].".  So please delete it first to remove this category");
    			return $this->redirect('categories.index')->withErrors($errors);
    		}else{
	    		try {
	    			$this->repository->delete($id);
	    			return $this->redirect('categories.index');
	    		} catch (ModelNotFoundException $e) {
	    			return $this->redirectNotFound();
	    		}
    		}
    	}
    }
}
