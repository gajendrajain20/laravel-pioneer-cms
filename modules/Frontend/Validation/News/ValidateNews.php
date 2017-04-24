<?php

namespace Modules\Frontend\Validation\News;

use Pingpong\Admin\Validation\Validator;

class ValidateNews extends Validator {

    protected $rules = [
          	'name' => 'required',
	        'email' => 'required|email',
	        'number' => 'required|numeric',
	 		'message' => 'required',
	    	'file' => 'required',
	    	'g-recaptcha-response' => 'required'
    ];

    public function rules() {
        return $this->rules;
    }

}
