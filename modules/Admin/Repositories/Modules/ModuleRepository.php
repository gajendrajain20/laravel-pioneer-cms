<?php

namespace Modules\Admin\Repositories\Modules;

interface ModuleRepository {

    /**
     * Get count of row being shown perpage.
     *
     * @return int
     */
    public function perPage();

    /**
     * Get all data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find data by given an identifier.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id);

    /**
     * Delete a specified data by given data id.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id);

    /**
     * Create a new data.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);
    
    /**
     * Returns a listing of Modules.
     *
     * @return Array
     */
    public function getAllModulesNames();
}
