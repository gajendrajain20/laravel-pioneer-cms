<?php

namespace Modules\Admin\Validation\Module;

use Pingpong\Admin\Validation\Validator;

class ModuleCreate extends Validator {

    protected $rules = [
        'zipName'=>'required'
    ];

    
    public function rules()
    {
    	return $this->rules;
    }

}
