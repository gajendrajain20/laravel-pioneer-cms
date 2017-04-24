<?php

namespace Modules\Admin\Http\Controllers;

use Pingpong\Admin\Controllers\BaseController;
use Artisan;
use Log;
use Storage;

class BackupController extends BaseController {

    public function index() {
        if (!count(config('laravel-backup.backup.destination.disks'))) {
            dd(trans('backup.no_disks_configured'));
        }

        $this->data['backups'] = [];

        foreach (config('laravel-backup.backup.destination.disks') as $disk_name) {
            $disk = Storage::disk($disk_name);
            $adapter = $disk->getDriver()->getAdapter();
            $files = $disk->allFiles();

            // make an array of backup files, with their filesize and creation date
            foreach ($files as $k => $f) {
                // only take the zip files into account
                if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                    $this->data['backups'][] = [
                        'file_path' => $f,
                        'file_name' => str_replace('backups/', '', $f),
                        'file_size' => $disk->size($f),
                        'last_modified' => $disk->lastModified($f),
                        'disk' => $disk_name,
                        'download' => ($adapter instanceof \League\Flysystem\Adapter\Local) ? true : false,
                    ];
                }
            }
        }

        // reverse the backups, so the newest one would be on top
        $this->data['backups'] = array_reverse($this->data['backups']);
        $this->data['title'] = 'Backups';

        return $this->view('backup.backup', $this->data);
    }

    public function create() {

        try {
        	echo "<pre>";
            ini_set('max_execution_time', 3000);
            // start the backup process
            Artisan::call('backup:run');
            $output = Artisan::output();

            // log the results
            Log::info("LuisMareze\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            echo $output;
        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }

        return 'success';
    }

    /**
     * Downloads a backup zip file.
     */
    public function download() {
        $disk = Storage::disk(\Request::input('disk'));
        $file_name = \Request::input('file_name');
        $adapter = $disk->getDriver()->getAdapter();

        if ($adapter instanceof \League\Flysystem\Adapter\Local) {
            $storage_path = $disk->getDriver()->getAdapter()->getPathPrefix();

            if ($disk->exists($file_name)) {
                return response()->download($storage_path . $file_name);
            } else {
                abort(404, trans('backup.backup_doesnt_exist'));
            }
        } else {
            abort(404, trans('backup.only_local_downloads_supported'));
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name) {
        $disk = Storage::disk(\Request::input('disk'));

        if ($disk->exists($file_name)) {
            $disk->delete($file_name);

            return 'success';
        } else {
            abort(404, trans('backup.backup_doesnt_exist'));
        }
    }

}
