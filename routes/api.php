<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'folder' => FolderController::class,
    'file' => FileController::class
]);
