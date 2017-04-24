<?php

namespace Modules\Admin\Validation\Video;

use Pingpong\Admin\Validation\Validator;

class VideoCreate extends Validator {

    protected $rules = [
        'title' => 'required',
        'slug' => 'unique:videos,slug',
    ];

    public function rules() {
        return $this->rules;
    }

}
