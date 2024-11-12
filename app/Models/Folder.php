<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    /** @use HasFactory<\Database\Factories\FolderFactory> */
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function sub()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }
}
