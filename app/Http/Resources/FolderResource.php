<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sub_folders' => $this->when(!$this->sub->isEmpty(), FolderCollection::make($this->sub)),
            'files' => $this->when(!$this->files->isEmpty(), FileCollection::make($this->files)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
