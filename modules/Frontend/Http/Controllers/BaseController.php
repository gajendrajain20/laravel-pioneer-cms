<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Frontend\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Pingpong\Admin\Entities\Option;
use Illuminate\Support\Facades\Redirect;
use View;
/**
 * Description of BaseController
 *
 * @author admin
 */
class BaseController extends Controller {
	
     protected $site_settings;
     
     protected $theme="default";
    /**
     * default constructor
     *
     * @return mixed
     */
    public function __construct() {
        
        // Fetch the Site Settings object
        $this->site_settings = Option::all()->toArray();
        $settings=array();
        foreach($this->site_settings as $setting){
            $settings[$setting['key']]=$setting['value'];
        }
       
        //get all the template names & add theme location to the views
        if(option('site.template')!=''){
        
	        \View::addLocation('../resources/views/templates/'.option('site.template'));
	        \View::addNamespace(option('site.template'), '../resources/views/templates/'.option('site.template'));
        }else{
            \View::addLocation('../resources/views/templates/default');
            \View::addNamespace('default', '../resources/views/templates/default');
        }
        
        $this->theme = (option('site.template')!='')?option('site.template'):"default";
        
        View::share('site_settings', $settings);
    }
    
    /**
     * Redirect to a route.
     *
     * @param $route
     * @param array $parameters
     * @param int   $status
     * @param array $headers
     *
     * @return mixed
     */
    public function redirect($route, $parameters = array(), $status = 302, $headers = array())
    {
    	return Redirect::route('frontend.'.$route, $parameters, $status, $headers);
    }
    
    /**
     * Show view.
     *
     * @param $view
     * @param array $data
     * @param array $mergeData
     *
     * @return mixed
     */
    public function view($view, $data = array(), $mergeData = array())
    {
    	return View::make($this->theme.'::'.$view, $data, $mergeData);
    }
    
    /**
     * Get all input data.
     *
     * @return array
     */
    public function inputAll()
    {
        return Input::all();
    }

}
