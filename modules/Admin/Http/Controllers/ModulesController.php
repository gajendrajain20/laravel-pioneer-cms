<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Controllers\BaseController;
use Modules\Admin\Validation\module\moduleCreate;
use Modules\Admin\Entities\Module;
use Modules\Admin\Validation\Module\ModuleCreatePingPong;
use Illuminate\Support\Facades\Artisan;

class ModulesController extends BaseController {

	function __construct(){
		  $this->repository = $this->getRepository();
	}
    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
            $repository = 'Modules\Admin\Repositories\Modules\ModuleRepository';
        return app($repository);
    }
    
    /**
     * Display a listing of modules.
     *
     * @return Response
     */
    public function index($query = null) {
    	$user = \Auth::user();

		$modules = $this->repository->allOrSearch();
		
		foreach ($modules as $module){
			if($module->is_active){
				$module->applied = true;
			}
		}
		
    	$no = $modules->firstItem();
    	return $this->view('modules.index', compact('modules', 'no'));
    }
   
    /**
     * Search in all modules.
     *
     * @return Response
     */
    public function search() {
    	return $this->index(Input::get());
    }
    
    
    /**
     * Store a newly uploaded theme/module in storage.
     *
     * @return Response
     */
    public function store(ModuleCreate $request) {
        $data = Input::all();
        $data['user_id'] = \Auth::user()->id;
        $data['route_name'] = $data['routeName'];
        unset($data['routeName']);
       
        $path = Input::file('zipName')->move('../modules',Input::file('zipName')->getClientOriginalName());
        $zip = new \ZipArchive();
        if ($zip->open($path) === TRUE) {
        	$folderName = basename($request->file('zipName')->getClientOriginalName(), '.'.$request->file('zipName')->getClientOriginalExtension());
        	$zip->extractTo('../modules/'.$folderName);
        	$zip->close();
        	unlink($path); 
        	
        	$data['zip_name'] =$folderName;
        } else {
        	echo "Zip extraction failed";
        }
        
        if($data['name']==""){
        	$data['name'] = $data['zip_name'];
        }
        ;
        $moduleData = $this->repository->create($data);
        
        return $this->redirect('modules.index');
    }
	
    /**
     * Show the form for creating a new module.
     *
     * @return Response
     */
    public function create()
    {	
    	return $this->view('modules.create');
    }
    
    /**
     * Apply the module to the frontend
     *
     * @param int $id
     *
     * @return Response
     */
    public function apply($id) {
       //Activating the module
       $module = $this->repository->findById($id);
       $module->is_active = '1';
       $moduleData = $module->toArray();
    	 
	   $module->update($moduleData);
       return redirect('admin/modules');
    }
    
    /**
     * Deativate the module to the frontend
     *
     * @param int $id
     *
     * @return Response
     */
    public function deactivate($id) {
    	$module = $this->repository->findById($id);
    	$module->is_active = '0';
    	//Disabling the module from artisan command
//     	Artisan::call('module:disable '.$module->name);
    	$moduleData = $module->toArray();
    	 
    	$module->update($moduleData);
    	 
    	return redirect('admin/modules');
    }
    
    
    /**
     * Show the form for editing the specified module.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id) {
//     	try {
//     		$user = \Auth::user();
//     		$user_id = 0;
//     		if (!$user->is('admin')) {
//     			$user_id = $user->id;
//     		}
//     		$module = $this->repository->findById($id);
    
//     		return $this->view('modules.edit', compact('module'));
//     	} catch (ModelNotFoundException $e) {
//     		return $this->redirectNotFound();
//     	}
    }

    /**
     * Update the specified module in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(ModuleCreate $request, $id) {
        try {

            $module = $this->repository->findById($id);

            $data = $request->all();
           
            $module->update($data);

            return $this->redirect('modules.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
    

     /**
     * Remove the specified module from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id) {
    	try {
    		$module = $this->repository->findById($id);
    		
    		if(isset($module->id)){
    		   
    		    //creating a flag with name deletionFailed so that it can b 
    		    // set to 1 if deletion of module is failed using module name
    		    $deletionFailed=0;
    		    
	    		if($module->name != ''|| $module->name != null){
	    			//deleting the extracted files also using module name
	    			$dir = '../modules/'.$module->name;
	    			
	    			try{
	    				$deleted = $this->delTree($dir);
	    				$this->repository->delete($id);
	    			}catch (\ErrorException $error){
	    			    $deletionFailed = 1;
	    			}
	    			
	    			if($deletionFailed){
	    			    //deleting the extracted files using zip name
	    			    $dir = '../modules/'.$module->zip_name;
	    			    
	    			    try{
	    			        $deleted = $this->delTree($dir);
	    			        $this->repository->delete($id);
	    			    }catch (\ErrorException $error){
    	    				return $this->redirect('modules.index')->withFlashMessage('Some error occured while deleting the file');
	    			    }
	    			}
	    		}
    		}	
    		return $this->redirect('modules.index');
    	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
    	}
    }
    
    
    /**
     * Deletes a directory with content in it
     */
    public function delTree($dir) {
    	$files = array_diff(scandir($dir), array('.','..'));
    	foreach ($files as $file) {
    		(is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
    	}
    	return rmdir($dir);
    }
	
    
    /**
     * Returns a listing of Modules.
     *
     * @return array
     */
    public function getAllModulesNames()
    {
    	return $this->repository->getAllModulesNames();
    }
    
    /**
     * Creates a module using pingpong's inbuilt module creation feature
     *
     * @return Response
     */
    public function createModule(ModuleCreatePingPong $request) {
    	$data = $request->all();
    	Artisan::call('module:make', ['name' => [$data['moduleName']]] );
    	
    	//setting important variables for table
    	$data['user_id'] = \Auth::user()->id;
    	$refinedModuleName= preg_replace('/\s+/', '', $data['moduleName']);
    	$data['name'] = $refinedModuleName;
    	unset($data['moduleName']);
    	$moduleData = $this->repository->create($data);
    	return \Redirect::to(route('admin.modules.index'));
    }
}
