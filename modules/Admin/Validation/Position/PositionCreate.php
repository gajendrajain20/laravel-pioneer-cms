<?php

namespace Modules\Admin\Validation\Position;

use Pingpong\Admin\Validation\Validator;

class PositionCreate extends Validator {

    protected $rules = [
        'position' => 'required',
    ];

    public function rules() {
        return $this->rules;
    }

}
