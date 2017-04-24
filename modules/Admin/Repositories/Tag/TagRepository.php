<?php

namespace Modules\Admin\Repositories\Tag;

interface TagRepository {

    /**
     * Find data by given an identifier.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id);
    
    /**
     * Find data by given an identifier.
     *
     * @param int $tagName
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByName($tagName);

    /**
     * Delete a specified data by given data id.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id);

    /**
     * Add a new tag.
     *
     * @param string $tag
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addTag($tag);

    /**
     * Create a new data.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);
}
