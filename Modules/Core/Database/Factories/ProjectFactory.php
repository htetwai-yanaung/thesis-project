<?php

namespace Modules\Core\Database\Factories;

use Database\Factories\UserFactory;
use Modules\Core\App\Models\ThesisProject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ThesisProject::class;

    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->words(100, true),
            'category_id' => fake()->numberBetween(1,3),
            'year_id' => fake()->numberBetween(1,6),
            'project_type' => fake()->numberBetween(1,2),
            'user_id' => new UserFactory(),
            'status' => 1,
        ];
    }
}
