<?php

namespace Database\Factories;

use App\Models\Projectcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'project_category' => Projectcategory::first()?->id ?? Projectcategory::factory(),
            'name' => fake()->sentence(3),
            'project_code' => fake()->unique()->bothify('cbt-####'),
            'project_key' => fake()->numberBetween(11111, 99999),
            'status' => fake()->randomElement(['Active', 'Completed']),
            'is_featured' => fake()->boolean(),
            'priority' => fake()->randomElement(['Low', 'Medium', 'High']),
            'progress' => fake()->numberBetween(0, 100),
            'budget' => fake()->randomFloat(2, 1000, 50000),
            'project_url' => fake()->url(),
            'started_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'completed_at' => fake()->dateTimeBetween('now', '+1 year'),
            'deadline_time' => fake()->dateTimeBetween('now', '+6 months'),
            'project_type' => fake()->randomElement(['Internal', 'Client']),
            'technologies' => fake()->randomElements(['Laravel', 'React', 'Vue', 'Node'], 2),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(640, 480, 'projects'),
            'client_name' => fake()->name(),
            'client_email' => fake()->safeEmail(),
            'client_phone' => fake()->phoneNumber(),
            'client_company' => fake()->company(),
            'client_pan' => fake()->regexify('[A-Z]{3}[PCHFATBLJG]{1}[A-Z]{1}[0-9]{4}[A-Z]{1}'),
            'client_website' => fake()->url(),
            'client_address' => fake()->address(),
        ];
    }
}
