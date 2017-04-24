<?php

namespace Modules\Admin\Repositories\MenuType;

interface MenuTypeRepository {

    /**
     * Get all data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();
}
