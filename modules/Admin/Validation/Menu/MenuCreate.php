<?php

namespace Modules\Admin\Validation\Menu;

use Pingpong\Admin\Validation\Validator;

class MenuCreate extends Validator {

    protected $rules = [
        'title' => 'required'
    ];

    public function rules() {
        return $this->rules;
    }

}
