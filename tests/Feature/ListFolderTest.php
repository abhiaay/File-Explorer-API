<?php

namespace Tests\Feature;

use App\Models\Folder;
use Database\Seeders\FolderSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListFolderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(FolderSeeder::class);
    }

    public function test_list(): void
    {
        $response = $this->getJson(route('folder.index'));

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);

        $response->assertOk();
    }

    public function test_list_child(): void
    {
        $folder = Folder::whereNotNull('parent_id')->first();
        $response = $this->getJson(route('folder.show', ['folder' => $folder]));

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'id',
                'name',
                'parent' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at'
                ],
                'created_at',
                'updated_at'
            ]
        ]);

        $response->assertOk();
    }
}
