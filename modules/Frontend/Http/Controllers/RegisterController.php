<?php

namespace Modules\Frontend\Http\Controllers;

use Modules\Frontend\Validation\Register\ValidateUserRegistration;
use Pingpong\Admin\Repositories\Users\UserRepository;

class RegisterController extends BaseController
{

    
    /**
     * @var UserRepository
     */
    protected $repository;
    
    
    /**
     * @param \User $users
     */
    public function __construct(UserRepository $repository)
    {   
        $this->repository = $repository;
        
        parent::__construct();
    }
    
    /**
     * Show login page.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->view('register');
    }

    /**
     * Login action.
     *
     * @return mixed
     */
    public function store(ValidateUserRegistration $request)
    {
        $data = $request->all();
        
        try {
            $user = $this->repository->create($data);
            
            $user->addRole('2'); // 2 is for Frontend User Role
            
           
        } catch (\Exception $e) {
            return \Redirect::back()->withFlashMessage('Registration failed!')->withFlashType('danger');
        }
        
        $credentials = [
            "email" => $data['email'],
            "password" => $data['password']
        ];
        
        if (\Auth::attempt($credentials, $remember = false)) {
            return $this->redirect('home')->withFlashMessage('Registration Success!');
        }
    }
}
