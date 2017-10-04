<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Http\Controllers\BaseController;
use GuzzleHttp\Client;
use Input;

class ContactController extends BaseController {

	public function __construct()
	{	parent::__construct();
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
     * Get repository instance.
     *
     * @return mixed
     */
    public function getPageRepository() {
        $repository = 'Pingpong\Admin\Repositories\Pages\PageRepository';
        return app($repository);
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getMenuRepository() {
        $repository = 'Modules\Admin\Repositories\Menu\MenuRepository';
        return app($repository);
    }

    /**
     * index action
     *
     * @return mixed
     */
    public function index($id = null) {
        $menu = $this->getMenuRepository()->findByKey('slug','contact-us')->toArray();
        $article = $this->getPageRepository()->findById($menu[0]['post_id']);
        return view($this->theme.'::contact.index',compact('article'));
    }

    /**
     * Store a newly created article in storage.
     *
     * @return Response
     */
    public function Store() {
        $data = Input::all();
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
    		$contactData = $this->repository->create($data);
    		$message = "Success";

    	}else{
    		$message = "Captcha failed";
    	}

    	return $message;
    }

}
