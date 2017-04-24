<?php

namespace Modules\Admin\Validation\Article;

use Pingpong\Admin\Validation\Article\Create;

class AdminCreate extends Create {
    
    protected $rules = [
        'title' => 'required',
        'slug' => 'required|unique:articles,slug',
        'category_id' => 'required',
        'body' => 'required',
    ];
    
    public function rules()
    {   
        if (isOnPages()) {
            unset($this->rules['category_id']);
        }
        return $this->rules;
    }
    
}
