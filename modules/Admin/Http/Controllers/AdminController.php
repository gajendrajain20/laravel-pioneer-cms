<?php

namespace Modules\Admin\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class AdminController extends Controller {

    public function index() {
        return view('Admin::index');
    }

}
