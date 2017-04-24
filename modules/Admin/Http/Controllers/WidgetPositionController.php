<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Pingpong\Admin\Controllers\BaseController;
use Modules\Admin\Validation\Position\PositionCreate;

class WidgetPositionController extends BaseController {

    public function __construct() {
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
        $repository = 'Modules\Admin\Repositories\WidgetPosition\WidgetPositionRepository';
        return app($repository);
    }

    
    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound() {
    	return $this->redirect('positions.index')
    	->withFlashMessage('Position not found!')
    	->withFlashType('danger');
    }
    
    /**
     * Display a listing of positions.
     *
     * @return Response
     */
    public function index($query = null) {
    	$user=\Auth::user();
    	$user_id=0;
    	if(!$user->is('admin')){
    		$user_id=$user->id;
    	}
    	$positions = $this->repository->allOrSearch($query,$user_id);
    
    	$no = $positions->firstItem();
    	return $this->view('positions.index', compact('positions', 'no'));
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
     * Show the form for creating a new positions.
     *
     * @return Response
     */
    public function create() {
    	return $this->view('positions.create');
    }
    
    /**
     * Display the specified video.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id) {
    	try {
    		$positions = $this->repository->findById($id);
    
    		return $this->view('positions.show', compact('positions'));
    	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
    	}
    }
    
    /**
     * Store a newly created video in storage.
     *
     * @return Response
     */
    public function store(PositionCreate $request) {
    
    	$data = $request->all();
    	$data['user_id'] = \Auth::id();
    
    	$positionData = $this->repository->create($data);
    	return $this->redirect('positions.index');
    }
    
    /**
     * Show the form for editing the specified video.
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
    		$position = $this->repository->findById($id,$user_id);
    		if(!isset($position)){
    			return $this->redirectNotFound();
    		}
    		 
    		return $this->view('positions.edit', compact('position'));
    	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
    	}
    }
    
    /**
     * Update the specified video in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(PositionCreate $request, $id) {
    	try {
    
    		$position = $this->repository->findById($id);
    
    		$data = $request->all();
    		$data['user_id'] = \Auth::id();
    
    		$position->update($data);
    
    		return $this->redirect('positions.index');
    	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
    	}
    }
    
    /**
     * Remove the specified video from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id) {
    	try {
    		$this->repository->delete($id);
    
    		return $this->redirect('positions.index');
    	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
    	}
    }
    
    /**
     * Gets all the position from the storage.
     *
     * @return array
     */
    public function getAll() {
    	try {
    		return $this->repository->getAllPositions();
    	} catch (ModelNotFoundException $e) {
    		return $e->getMessage();
    	}
    }
}
