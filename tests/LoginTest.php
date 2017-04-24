<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{

    public function testLoginPageAccess(){
		$this->visit('/admin/login')
		->see('Sign In');	
    }
  
    public function testLoginSuccess(){
        $this->visit('/admin/login')
        ->type('admin@mailinator.com', 'email')
        ->type('admin', 'password')
        ->press('Sign me in')
        ->seePageIs(route('admin.home'));
    }
    
    public function testLoginFailureWithWrongEmail(){
    	$this->visit(route('admin.login.index'))
         ->type('wrongemail@gmail.com', 'email')
         ->type('Qwe@1234', 'password')
         ->press('Sign me in')
         ->seePageIs(route('admin.login.index'));
    } 
    
    public function testLoginFailureWithWrongPassword(){
    	$this->visit(route('admin.login.index'))
    	->type('admin@mailinator.com', 'email')
    	->type('adminss', 'password')
    	->press('Sign me in')
    	->seePageIs(route('admin.login.index'));
    }
    
    public function testLoginFailureWithWrongPasswordAndEmail(){
    	$this->visit(route('admin.login.index'))
    	->type('wrongadmin@mailinator.com', 'email')
    	->type('adminss', 'password')
    	->press('Sign me in')
    	->seePageIs(route('admin.login.index'));
    }
    
    public function testLoginFailureWithEmptyPassword(){
    	$this->visit(route('admin.login.index'))
    	->type('admin@mailinator.com', 'email')
    	->type('', 'password')
    	->press('Sign me in')
    	->seePageIs(route('admin.login.index'));
    }
    
    public function testLoginFailureWithEmptyEmail(){
    	$this->visit(route('admin.login.index'))
    	->type('', 'email')
    	->type('admin', 'password')
    	->press('Sign me in')
    	->seePageIs(route('admin.login.index'));
    }
    
    public function testLoginFailureWithEmptyEmailAndPassword(){
    	$this->visit(route('admin.login.index'))
    	->type('', 'email')
    	->type('', 'password')
    	->press('Sign me in')
    	->seePageIs(route('admin.login.index'));
    }   
}
