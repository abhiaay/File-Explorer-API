<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Models\Folder;
use App\Repositories\FileRepository;
use App\Traits\Http\ResponseTrait;

class FileController extends Controller
{
    use ResponseTrait;

    public function __construct(protected FileRepository $fileRepository)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $data = $request->validated();
        if(!empty($data['folder_id'])) {
            $parent = Folder::find($data['folder_id']);
        }

        $folder = $this->fileRepository->create($data['name'], $parent ?? null);

        return $this->successResponse(new FileResource($folder));
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
