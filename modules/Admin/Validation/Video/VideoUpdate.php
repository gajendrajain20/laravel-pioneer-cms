<?php

namespace Modules\Admin\Validation\Video;

use Pingpong\Admin\Validation\Validator;

class VideoUpdate extends Validator {

    protected $rules = [
        'title' => 'required',
    ];

    public function rules() {
        return $this->rules;
    }

}
