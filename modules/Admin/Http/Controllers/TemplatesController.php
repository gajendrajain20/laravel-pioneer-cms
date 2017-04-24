<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Controllers\BaseController;
use Modules\Admin\Validation\Template\TemplateCreate;
use Pingpong\Admin\Entities\Option;

class TemplatesController extends BaseController {

	function __construct(){
		  $this->repository = $this->getRepository();
	}
    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository() {
            $repository = 'Modules\Admin\Repositories\Templates\TemplateRepository';
        return app($repository);
    }
    
    /**
     * Display a listing of templates.
     *
     * @return Response
     */
    public function index($query = null) {
    	$user = \Auth::user();

		$templates = $this->repository->allOrSearch();
		
		
		if(option('site.template')!=''){
			foreach ($templates as $template){
				if($template->zip_name == option('site.template')){
// 					$template->name = $template->name." (Currently Applied)";
					$template->applied = true;
				}
			}
		}

    	$no = $templates->firstItem();
    	return $this->view('templates.index', compact('templates', 'no'));
    }
   
    /**
     * Search in all templates.
     *
     * @return Response
     */
    public function search() {
    	return $this->index(Input::get());
    }
    
    
    /**
     * Store a newly uploaded theme/template in storage.
     *
     * @return Response
     */
    public function store(TemplateCreate $request) {
        $data = Input::all();
        $data['user_id'] = \Auth::user()->id;
       
        
        $path = Input::file('zipName')->move('../resources/views/templates/',Input::file('zipName')->getClientOriginalName());
        $zip = new \ZipArchive();
        if ($zip->open($path) === TRUE) {
        	$folderName = basename($request->file('zipName')->getClientOriginalName(), '.'.$request->file('zipName')->getClientOriginalExtension());
        	
        	//checking if a template with same filename has been uploaded before or not
        	//if uploaded then reject this one.
        	$fileExists = $this->repository->findByFileName($folderName);
        	//removing null or empty value keys.
        	$refinedFileExists = array_filter($fileExists);

        	if(empty($refinedFileExists)){
        		$data['zip_name'] = $folderName;
        	}else{
        		//delete the zip file
        		unlink($path);
        		if(strtolower($folderName) == 'default'){
        			return \Redirect::back()->withInput(Input::all())
        			->withFlashMessage('Default template can not be altered. Please choose another file.');
        		}else{
        			return \Redirect::back()->withInput(Input::all())
        			->withFlashMessage('This zip already exists. Please choose another file.');
        		}
        	}
        	
        	//extract the uploaded zip file
        	$zip->extractTo('../resources/views/templates/'.$folderName);
        	$zip->close();
        	//delete the zip file
        	unlink($path); 
        	
        	$dir = '../resources/views/templates/'.$folderName;
        	$assetsList = array('css','js','images','fonts');
        	$destinationFolder = "../public/templates/".$folderName;
        	
        	if (!file_exists($destinationFolder)) {
        		mkdir($destinationFolder);
        	}
        	//moving css,js,images,fonts folder to public assets folder
        	$files = array_diff(scandir($dir), array('.','..'));
        	foreach ($files as $file) {
        		if(is_dir("$dir/$file") && in_array($file, $assetsList)){
        			if (!file_exists($destinationFolder."/$file")) {
        				mkdir($destinationFolder."/$file");
        			}
        			$this->moveFiles("$dir/$file", $destinationFolder."/$file");
        		}
        	}
        } else {
        	echo "Zip extraction failed";
        }
        
        if($data['name']==""){
        	$data['name'] = $data['zip_name'];
        }
        
        $templateData = $this->repository->create($data);
        
        return $this->redirect('templates.index');
    }
	
    /**
     * Show the form for creating a new template.
     *
     * @return Response
     */
    public function create()
    {	
    	return $this->view('templates.create');
    }
    
    /**
     * Apply the template to the frontend
     *
     * @param int $id
     *
     * @return Response
     */
    public function apply($id) {
       //Applying the theme goes here
       $template = $this->repository->findById($id);
       $zipName = $template->zip_name;
        Option::findByKey('site.template')->update([
        	'value' =>$zipName ,
        ]);
        	
           return redirect('admin/templates');
    }
    
    /**
     * Deativate the template to the frontend
     *
     * @param int $id
     *
     * @return Response
     */
    public function deactivate() {
    	Option::findByKey('site.template')->update([
    			'value' =>'default' ,
    	]);
    	 
    	return redirect('admin/templates');
    }
    
    
    /**
     * Show the form for editing the specified template.
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
//     		$template = $this->repository->findById($id);
    
//     		return $this->view('templates.edit', compact('template'));
//     	} catch (ModelNotFoundException $e) {
    		return $this->redirectNotFound();
//     	}
    }

    /**
     * Update the specified template in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(TemplateCreate $request, $id) {
//         try {

//             $template = $this->repository->findById($id);

//             $data = $request->all();
           
//             $template->update($data);

            return $this->redirect('templates.index');
//         } catch (ModelNotFoundException $e) {
//             return $this->redirectNotFound();
//         }
    }
    

     /**
     * Remove the specified template from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id) {
    	try {
    		$template = $this->repository->findById($id);
    		
    		if(isset($template->id)){
	    		if(option('site.template') == $template->zip_name ){
	    			
	    			Option::findByKey('site.template')->update([
	    					'value' =>'default' ,
	    			]);
	    		}
	    		
	    		$this->repository->delete($id);
	    		
	    		//deleting the extracted files also
	    		$dir = '../resources/views/templates/'.$template->zip_name;
	    		$assetsDir = '../public/templates/'.$template->zip_name;
	    		try{
	    			$deleted = $this->delTree($dir);
	    			$deletedAssets = $this->delTree($assetsDir);
	    		}catch(\ErrorException $error){
	    			return $this->redirect('templates.index')->withFlashMessage('Some error occured while removing the template files');
	    		}
    		}
    		return $this->redirect('templates.index');
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
     *  Move the contents of a directory to another
     */
	public function moveFiles($source, $destination){
		
		// Get array of all source files
		$files = scandir($source);

		// Cycle through all source files
		foreach ($files as $file) {
			if (in_array($file, array(".",".."))) continue;
			// If we copied this successfully, mark it for deletion
			if (copy($source."/".$file, $destination."/".$file)) {
				$delete[] = $source."/".$file;
			}
		}
		
		//Delete all successfully-copied files
		foreach ($delete as $file) {
			unlink($file);
		}
		
		//delete the folder also
		rmdir($source);
	}
}
