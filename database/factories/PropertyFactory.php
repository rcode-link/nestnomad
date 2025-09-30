<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
final class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'address' =>  [
                "address" => $this->faker->address,
                "street" => $this->faker->streetAddress,
                "postcode" => $this->faker->postcode,
                "place" => $this->faker->name,
                "region" => $this->faker->name,
                "country" =>  $this->faker->name,
                "placeName" => $this->faker->address,
                "coords" => [
                    18.367101,
                    43.82666,
                ],
            ],


        ];
    }
}
