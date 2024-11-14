<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Folder;

class FileRepository
{
    public function create(string $name, Folder $folder = null):File
    {
        $file = new File();
        $file->name = $name;

        if($folder) {
            $file->folder_id = $folder->id;
        }
        $file->size = random_int(1000, 10485760);
        $file->save();

        return $file;
    }
}
