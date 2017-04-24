<?php

namespace Modules\Admin\Presenters;

use Pingpong\Presenters\Presenter;

class Video extends Presenter {

    public function image_path() {
        return public_path("images/videos/{$this->entity->image}");
    }

}
