<?php

namespace Modules\Admin\Validation\Widget;

use Pingpong\Admin\Validation\Validator;

class WidgetUpdate extends Validator {

	protected $rules = array();
	
	function __construct(){
		if( null !== request('module')){
			 $this->rules = [
					'title' => 'required',
					'device'=>'required'
			];
		}else{
			 $this->rules = [
					'title' => 'required',
					'device'=>'required',
			 		'description' => 'required'
			];
		}
		
	}
    public function rules() {
        return $this->rules;
    }

}
