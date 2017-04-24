<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Admin\Http\Controllers;

use Pingpong\Admin\Controllers\SiteController;
use Pingpong\Admin\Uploader\ImageUploader;
use Pingpong\Admin\Entities\Option;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

/**
 * Description of SiteController
 *
 * @author admin
 */
class SitesController extends SiteController {

    /**
     * @var ImageUploader
     */
    protected $uploader;

    /**
     * @param ImageUploader $uploader
     */
    public function __construct(ImageUploader $uploader) {
        $this->uploader = $uploader;
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getArticleRepository() {

        $repository = 'Pingpong\Admin\Repositories\Articles\ArticleRepository';

        return app($repository);
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getUserRepository() {
        $repository = 'Pingpong\Admin\Repositories\Users\UserRepository';
        return app($repository);
    }
    
    /**
     * Update the settings.
     *
     * @return mixed
     */
    public function updateSettings() {

        $settings = \Input::all();
        unset($settings['site_logo']);
        unset($settings['site_footer_logo']);
        unset($settings['site_favicon']);
        if (\Input::hasFile('site_logo')) {
            $this->uploader->upload('site_logo')->save('images/site');
            $settings['site_logo'] = $this->uploader->getFilename();
        }
        if (\Input::hasFile('site_footer_logo')) {
            $this->uploader->upload('site_footer_logo')->save('images/site');
            $settings['site_footer_logo'] = $this->uploader->getFilename();
        }
        if (\Input::hasFile('site_favicon')) {
            $this->uploader->upload('site_favicon')->save('images/site');
            $settings['site_favicon'] = $this->uploader->getFilename();
        }

        foreach ($settings as $key => $value) {
            $option = str_replace('_', '.', $key);

            Option::findByKey($option)->update([
                'value' => $value,
            ]);
        }

        return \Redirect::back()->withFlashMessage('Settings has been successfully updated!');
    }
    
    /**
     * Show the filemanager popup window.
     *
     * @return mixed
     */
    public function showFileManagerPopup() {
    	return view('admin::filemanager.index');
    }
    
}
