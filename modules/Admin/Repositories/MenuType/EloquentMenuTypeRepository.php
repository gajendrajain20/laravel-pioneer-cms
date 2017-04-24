<?php

namespace Modules\Admin\Repositories\MenuType;

use Modules\Admin\Entities\MenuType;
use Modules\Admin\Repositories\MenuType\MenuTypeRepository;

class EloquentMenuTypeRepository implements MenuTypeRepository {

    public function getModel() {
        $model = config('admin.menutype.model');
        return new $model();
    }

    public function getAll() {
        return $this->getModel()->get();
    }

}
