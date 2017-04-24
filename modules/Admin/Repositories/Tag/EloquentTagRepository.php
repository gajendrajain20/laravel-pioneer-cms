<?php

namespace Modules\Admin\Repositories\Tag;

use Modules\Admin\Entities\Tag;
use Modules\Admin\Repositories\Tag\TagRepository;

class EloquentTagRepository implements TagRepository {

    public function getModel() {
        $model = config('admin.tag.model');
        return new $model();
    }

    public function findById($id) {
        return $this->getModel()->find($id)->toArray();
    }
    
    public function findByName($tag) {
     	$exists = $this->getModel()->All()->where('tag', $tag)->toArray();
        if (empty($exists)) {
            return "NA";
        } else {
            return $exists[array_keys($exists)[0]];
        }
    }

    public function delete($id) {
        $tag = $this->findById($id);

        if (!is_null($article)) {
            $article->delete();

            return true;
        }

        return false;
    }

    public function create(array $data) {
        return $this->getModel()->create($data);
    }

    public function addTag($tag) {
        $exists = $this->getModel()->All()->where('tag', $tag)->toArray();
        if (empty($exists)) {
            $data = array('tag' => $tag);
            return $this->create($data)->toArray();
        } else {
            return $exists[array_keys($exists)[0]];
        }
    }
    
    public function search($tag){
        $exists = $this->getModel()->where('tag', 'like', $tag.'%')->orWhere('tag', 'like', '%'.$tag)->latest()->get(['tag'])->toArray();
//         $exists = $this->getModel()->latest()->get(['tag'])->toArray();
        if (!empty($exists)) {
            return $exists;
        } else {
            return [];
        }
    }

}
