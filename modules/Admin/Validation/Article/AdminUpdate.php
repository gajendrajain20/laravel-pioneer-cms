<?php

namespace Modules\Admin\Validation\Article;

use Pingpong\Admin\Validation\Article\Update;

class AdminUpdate extends Update {
    
       protected   $rules =  [
            'title' => 'required',
        	'category_id'=>'required',
            'body' => 'required',
        ];
        
    public function rules() {
        if (isOnPages()) {
            unset($this->rules['category_id']);
        }
        
        return $this->rules;
    }

}
