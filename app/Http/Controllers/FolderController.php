<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use App\Http\Resources\FileCollection;
use App\Http\Resources\FolderCollection;
use App\Http\Resources\FolderResource;
use App\Models\File;
use App\Models\Folder;
use App\Repositories\FolderRepository;
use App\Traits\Http\ResponseTrait;
use Exception;
use Illuminate\Http\Response;

class FolderController extends Controller
{
    use ResponseTrait;

    public function __construct(protected FolderRepository $folderRepository)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rootFolders = Folder::whereNull('parent_id')->get();
        $rootFiles = File::whereNull('folder_id')->get();
        return $this->successResponse([
            'folders' => FolderCollection::make($rootFolders),
            'files' => FileCollection::make($rootFiles)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFolderRequest $request)
    {
        $data = $request->validated();
        if(!empty($data['parent'])) {
            $parent = Folder::find($data['parent']);
        }

        $folder = $this->folderRepository->create($data['name'], $parent ?? null);

        return $this->successResponse(new FolderResource($folder));
    }

    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {
        return $this->successResponse(new FolderResource($folder));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        $folder->delete();
        return $this->successResponse(code: Response::HTTP_NO_CONTENT);
    }
}
