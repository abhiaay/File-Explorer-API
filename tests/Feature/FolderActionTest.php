<?php

namespace Tests\Feature;

use App\Models\Folder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FolderActionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /*
    |------------------------
    | Create test case
    |------------------------
    */

    public function test_create_empty_body()
    {
        $response = $this->postJson(route('folder.store'));
        $response->assertUnprocessable();
    }

    public function test_create_long_long_name()
    {
        $response = $this->postJson(route('folder.store'), [
            'name' => $this->faker()->text(300) . $this->faker()->text(300)
        ]);

        $response->assertJsonStructure([
            'status',
            'message',
            'errors' => [
                'name'
            ]
        ]);

        $response->assertUnprocessable();
    }

    public function test_create()
    {
        $response = $this->postJson(route('folder.store'), [
            'name' => 'Movies'
        ]);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'id',
                'name',
                'created_at',
                'updated_at'
            ]
        ]);

        $response->assertOk();
    }

    public function test_create_with_parent()
    {
        $parent = Folder::factory()->create();

        $response = $this->postJson(route('folder.store'), [
            'name' => 'Movies',
            'parent' => $parent->id
        ]);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'id',
                'name',
                'parent' => [
                    'id',
                    'name'
                ],
                'created_at',
                'updated_at'
            ]
        ]);

        $response->assertOk();
    }

    /*
    |------------------------
    | Update test case
    |------------------------
    */

    public function test_update_not_found()
    {
        $response = $this->putJson(route('folder.update', ['folder' => 0]));
        $response->assertJsonStructure([
            'status',
            'message'
        ]);
        $response->assertNotFound();

    }

    public function test_update()
    {
        $folder = Folder::factory()->create();
        $response = $this->putJson(route('folder.update', ['folder' => $folder]));
        $response->assertJsonStructure([
            'status',
            'message'
        ]);
        $response->assertNotFound();

    }
}
