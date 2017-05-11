<?php

namespace Modules\Frontend\Validation\Register;

use Pingpong\Admin\Validation\Validator;

class ValidateUserRegistration extends Validator {

    protected $rules = [
          	'name' => 'required',
	        'dob' => 'required',
	        'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6|max:20',
    ];

    public function rules() {
        return $this->rules;
    }
    
    /**
     * Authorize.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // since we will allows anyone to register himslef/herself.
    }
}
