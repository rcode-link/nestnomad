<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lease>
 */
final class LeaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'user_id' => $user,
            'start_of_lease' => $this->faker->dateTimeBetween('-2 years'),
            'contract' => [
                "type" => "doc",
                "content" => [
                    [
                        "type" => "paragraph",
                        "content" => $this->faker->sentence,
                    ],
                ],
            ],
            'tenant_name' => $user->name,
        ];
    }
}
