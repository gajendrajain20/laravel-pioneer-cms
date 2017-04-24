<?php 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Pqb\FilemanagerLaravel\FilemanagerLaravel;

class FilemanagerLaravelController extends Controller {
	public function __construct(){
		// $this->middleware('auth');
		
	}
	public function getShow()
	{	
		return view('admin::filemanager.index');
	}
	
	public function getShowModal()
	{
		return view('admin::filemanager.index_modal');
	}
	
	public function getConnectors()
    {
        $extraConfig = array('dir_filemanager'=>'/admin');
        $f = FilemanagerLaravel::Filemanager($extraConfig);
        $f->connector_url = url('/').'/admin/filemanager/connectors';
        $f->run();
    }
    
    public function postConnectors()
    {
        $extraConfig = array('dir_filemanager'=>'/admin');
        $f = FilemanagerLaravel::Filemanager($extraConfig);
        $f->connector_url = url('/').'/admin/filemanager/connectors';
        $f->run();
    }

}
