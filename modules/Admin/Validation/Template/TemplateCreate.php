<?php

namespace Modules\Admin\Validation\Template;
use Pingpong\Admin\Validation\Validator;

class TemplateCreate extends Validator {

    protected $rules = [
    	'name'=>'required|unique:templates,name',
        'zipName'=>'required|mimes:zip'
    ];

    
    public function rules()
    {
    	return $this->rules;
    }

}
