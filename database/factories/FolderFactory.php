<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Folder>
 */
class FolderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'parent_id' => null
        ];
    }

     /**
     * Define the parent folder state.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withParent($parentFolder = null)
    {
        return $this->state(function (array $attributes) use ($parentFolder) {
            return [
                'parent_id' => $parentFolder ? $parentFolder->id : null,
            ];
        });
    }
}
