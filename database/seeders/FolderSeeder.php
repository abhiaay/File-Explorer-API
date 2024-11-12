<?php

namespace Database\Seeders;

use App\Models\Folder;
use Database\Factories\FolderFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factory = new FolderFactory();
        $rootFolders = $factory->count(10)->create();

        $rootFolders->each(function(Folder $rootFolder)use($factory) {
            $factory->count(3)->withParent($rootFolder)->create();
        });
    }
}
