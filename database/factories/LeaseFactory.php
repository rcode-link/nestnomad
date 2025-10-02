<?php

namespace Database\Factories;

use App\Models\Property;
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
        return [
            'start_of_lease' => $this->faker->dateTimeBetween('-2 years'),
            'property_id' => Property::inRandomOrder()->first()->id,
            'contract' => [
                "type" => "doc",
                "content" => [
                    [
                        "type" => "paragraph",
                        "content" => $this->faker->sentence,
                    ],
                ],
            ],
        ];
    }
}
