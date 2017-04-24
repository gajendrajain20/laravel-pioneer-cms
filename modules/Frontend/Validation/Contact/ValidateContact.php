<?php

namespace Modules\Frontend\Validation\Contact;

use Pingpong\Admin\Validation\Validator;

class ValidateContact extends Validator{

 protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
 		'message' => 'required',
 		'g-recaptcha-response' => 'required'
    ];

    public function rules() {
        return $this->rules;
    }

}
