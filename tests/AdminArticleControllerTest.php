<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminArticleControllerTest extends TestCase
{   
    use DatabaseTransactions;
    
    /**
     * A test to Add New Post Successfully
     *
     * @return void
     */
    public function testAddNewPostSuccess(){
        $this->visit('/admin/login')
            ->type('admin@mailinator.com', 'email')
            ->type('admin', 'password')
            ->press('Sign me in')
            ->seePageIs('/admin/dashboard');

        $this->visit(route('admin.articles.create'))->see('Add New')
            ->type('Article Test', 'title')
            ->type('article-test', 'slug')
            ->type('Dummy Description', 'body')
            ->check('category_id[0]') //checking the general category
            ->type('Dummy Meta Title', 'meta_title')
            ->type('Dummy Meta Description', 'meta_description')
            ->attach('C:\Users\Public\Pictures\Sample Pictures\Tulips.jpg', 'image')
            ->press('Save')
            ->seePageIs(route('admin.articles.index'));
    }
    
    /**
     * A test to verify the Validation failure while 
     * adding a new post
     *
     * @return void
     */
    public function testAddNewPostFailureDueToDuplicateSlug(){
        $this->visit('/admin/login')
            ->type('admin@mailinator.com', 'email')
            ->type('admin', 'password')
            ->press('Sign me in')
            ->seePageIs('/admin/dashboard');
        
        //creating a new post
        $this->visit(route('admin.articles.create'))->see('Add New')
            ->type('Article Test', 'title')
            ->type('article-test', 'slug')
            ->type('Dummy Description', 'body')
            ->check('category_id[0]') //checking the general category
            ->type('Dummy Meta Title', 'meta_title')
            ->type('Dummy Meta Description', 'meta_description')
            ->attach('C:\Users\Public\Pictures\Sample Pictures\Tulips.jpg', 'image')
            ->press('Save')
            ->seePageIs(route('admin.articles.index'));
        
        //again creating a new post with same data to get duplicate slug error
        $this->visit(route('admin.articles.create'))->see('Add New')
            ->type('Article Test', 'title')
            ->type('article-test', 'slug')
            ->type('Dummy Description', 'body')
            ->check('category_id[0]') //checking the general category
            ->type('Dummy Meta Title', 'meta_title')
            ->type('Dummy Meta Description', 'meta_description')
            ->attach('C:\Users\Public\Pictures\Sample Pictures\Tulips.jpg', 'image')
            ->press('Save')
            ->see('The slug has already been taken')
            ->seePageIs(route('admin.articles.create'));
    }
    
    /**
     * A test to verify the Validation failure while
     * adding a new post
     *
     * @return void
     */
    public function testAddNewPostFailureDueToCategoryNotPresent(){
        $this->visit('/admin/login')
            ->type('admin@mailinator.com', 'email')
            ->type('admin', 'password')
            ->press('Sign me in')
            ->seePageIs('/admin/dashboard');
    
        $this->visit(route('admin.articles.create'))->see('Add New')
            ->type('Article Tests', 'title')
            ->type('article-tests', 'slug')
            ->type('Dummy Description', 'body')
            ->type('Dummy Meta Title', 'meta_title')
            ->type('Dummy Meta Description', 'meta_description')
            ->attach('C:\Users\Public\Pictures\Sample Pictures\Tulips.jpg', 'image')
            ->press('Save')
            ->see('The category id field is required.')
            ->seePageIs(route('admin.articles.create'));
    }
    
    /**
     * A test to verify the Validation failure while
     * adding a new post
     *
     * @return void
     */
    public function testAddNewPostFailureDueToDescriptionNotPresent(){
        $this->visit('/admin/login')
            ->type('admin@mailinator.com', 'email')
            ->type('admin', 'password')
            ->press('Sign me in')
            ->seePageIs('/admin/dashboard');
    
        $this->visit(route('admin.articles.create'))->see('Add New')
            ->type('Article Tests', 'title')
            ->type('article-testing', 'slug')
            ->check('category_id[0]') //checking the general category
            ->type('Dummy Meta Title', 'meta_title')
            ->type('Dummy Meta Description', 'meta_description')
            ->attach('C:\Users\Public\Pictures\Sample Pictures\Tulips.jpg', 'image')
            ->press('Save')
            ->see('The body field is required.')
            ->seePageIs(route('admin.articles.create'));
    }
    
    /**
     * A test to verify the success of edit post
     */
    public function testEditPostSucess(){
        
        $this->visit('/admin/login')
            ->type('admin@mailinator.com', 'email')
            ->type('admin', 'password')
            ->press('Sign me in')
            ->seePageIs('/admin/dashboard');
        
        $this->visit(route('admin.articles.create'))->see('Add New')
            ->type('Article Test', 'title')
            ->type('article-test', 'slug')
            ->type('Dummy Description', 'body')
            ->check('category_id[0]') //checking the general category
            ->type('Dummy Meta Title', 'meta_title')
            ->type('Dummy Meta Description', 'meta_description')
            ->attach('C:\Users\Public\Pictures\Sample Pictures\Tulips.jpg', 'image')
            ->press('Save')
            ->seePageIs(route('admin.articles.index'));
    
        $this->visit(route('admin.articles.index'))
            ->click('Edit')
            ->see('Edit')
            ->type('Article Testing', 'title')
            ->type('article-testing', 'slug')
            ->press('Update')
            ->seePageIs(route('admin.articles.index'))
            ->see('Article Testing');
    }    
}
