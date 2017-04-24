<?php

namespace Modules\Admin\Validation\Module;

use Pingpong\Admin\Validation\Validator;

class ModuleCreatePingPong extends Validator {

    protected $rules = [
        'moduleName'=>'required'
    ];

    
    public function rules()
    {
    	return $this->rules;
    }

}
