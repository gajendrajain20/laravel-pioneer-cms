<?php

namespace Modules\Admin\Composers;

use Modules\Admin\Entities\Category;
use Modules\Admin\Http\Controllers\AdminCategoriesController;

class ArticleFormComposer
{
    public function compose($view)
    {	
//        $categories = Category::lists('name', 'id');
		
        $categoryController = new AdminCategoriesController(app('Pingpong\Admin\Repositories\Categories\CategoryRepository'));
        $categories = $categoryController->getHierarichalCategoriesTree();
     
        $view->with(compact('categories'));
    }
}
