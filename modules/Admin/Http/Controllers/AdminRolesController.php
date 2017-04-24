<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Entities\Role;
use Pingpong\Admin\Validation\Role\Create;
use Pingpong\Admin\Controllers\RolesController;

class AdminRolesController extends RolesController
{

    /**
     * Store a newly created role in storage.
     *
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();
        
        $role = $this->repository->create($data);
        
        if (count(\Input::get('permissions')) > 0) {
        	$role->permissions()->attach(\Input::get('permissions'));
        }
        
        return $this->redirect('roles.index');
    }
}
