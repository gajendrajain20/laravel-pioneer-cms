<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Http\Controllers\BaseController;
use Modules\Frontend\Validation\News\ValidateNews;
use Pingpong\Admin\Uploader\ImageUploader;
use GuzzleHttp\Client;

class NewsController extends BaseController {
	

	/**
	 * @var ImageUploader
	 */
	protected $uploader;
	
	/**
	 * @param ImageUploader $uploader
	 */
	public function __construct(ImageUploader $uploader)
	{	parent::__construct();
		$this->uploader = $uploader;
	
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
     * index action
     *
     * @return mixed
     */
    public function index() {
        return view($this->theme.'::news.index');
    }
    
    /**
     * Store a newly created article in storage.
     *
     * @return Response
     */
    public function Store(ValidateNews $request) {
    	
    	$data = $request->all();
    	$g_recaptcha_response = $data['g-recaptcha-response'];
    	
    	$client = new Client();
    	// disable cert verification
    	$client->setDefaultOption('verify', false);
    	
    	$r = $client->post('https://www.google.com/recaptcha/api/siteverify',
    			['body' => [
    					"secret" =>"6LfIvwcUAAAAAELHKkKyUb0QCuXRhCxNxvkZH3uL",
    					"response" => $g_recaptcha_response
    			]]);
    	 
    	$body = $r->getBody();
    	$bodyArray = json_decode($body, true);
    	 
    	if($bodyArray['success'])
    	{
    		$year = date('Y');
    		$month = date('m');
    		
    		unset($data['file']);
    		if (\Input::hasFile('file')) {
    			// upload image
    			$this->uploader->upload('file')->save('images/news/'.$year.'/'.$month);
    			$data['file'] = $year."/".$month."/".$this->uploader->getFilename();
    		}

       		$this->repository->create($data);
       		return \Redirect::to('/submit-news')->withFlashMessage('News Submitted Successfully!')->withFlashType('success');
    	
    	}else{
    		return \Redirect::to('/submit-news')->withFlashMessage('Captcha Failed!')->withFlashType('danger');
    	}
    }

}
