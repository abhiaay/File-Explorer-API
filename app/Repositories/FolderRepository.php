<?php

namespace App\Repositories;

use App\Models\Folder;

class FolderRepository
{
    public function create(string $name, Folder $parent = null):Folder
    {
        $folder = new Folder();
        $folder->name = $name;

        if($parent) {
            $folder->parent_id = $parent->id;
        }
        $folder->save();

        return $folder;
    }
}
