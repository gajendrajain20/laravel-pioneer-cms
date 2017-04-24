<?php

namespace Modules\Admin\Http\Controllers;

use Pingpong\Admin\Controllers\BaseController;

class AdminContactController extends BaseController {  
      
	
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
		$repository = 'Modules\Frontend\Repositories\Contact\ContactRepository';
	
		return app($repository);
	}
    
    /**
     * Display a listing of contacts.
     *
     * @return Response
     */
    public function index($query = null)
    {
    	$contacts = $this->repository->allOrSearch($query);
   	
    	return $this->view('contacts.index', compact('contacts', 'no'));
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
    		$contact = $this->repository->findById($id);

    		return $this->view('contacts.show', compact('contact'));
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
    
    		return $this->redirect('contacts.index');
    	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
    	}
    }
}
