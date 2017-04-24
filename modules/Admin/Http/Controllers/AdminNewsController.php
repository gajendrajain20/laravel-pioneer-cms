<?php

namespace Modules\Admin\Http\Controllers;

use Pingpong\Admin\Controllers\BaseController;

class AdminNewsController extends BaseController {  
      
	
	public function __construct()
	{
		$this->repository = $this->getRepository();
	}
	
	
	/**
	 * Get repository instance.
	 *
	 * @return mixed
	 */
	public function getRepository() {
		$repository = 'Modules\Frontend\Repositories\News\NewsRepository';
	
		return app($repository);
	}
    
    /**
     * Display a listing of contacts.
     *
     * @return Response
     */
    public function index($query = null)
    {
    	$news = $this->repository->allOrSearch($query);
   	
    	return $this->view('news.index', compact('news'));
    }
    

    /**
     * Search in all articles.
     *
     * @return Response
     */
    public function search()
    {
    	return $this->index(Input::get());
    }
    
    
    /**
     * Show the contact details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id) {
    	try {
    		$news = $this->repository->findById($id);
    		$news['file'] = "/public/images/news/".$news['file'];
    		
    		return $this->view('news.show', compact('news'));
    	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
    	}
    }
    
    
    /**
     * Remove the specified article from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
    	try {
    		$this->repository->delete($id);
    
    		return $this->redirect('news.index');
    	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
    	}
    }
}
