<?php

use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'folder' => FolderController::class
]);
