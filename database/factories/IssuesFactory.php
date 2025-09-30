<?php

namespace Database\Factories;

use App\Enums\IssueStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issues>
 */
final class IssuesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('email', '!=', 'landlord@email.com')->inRandomOrder()->first()->id,
            'status' => fake()->randomElement(IssueStatus::cases()),
            'title' => fake()->title,
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => fake()->dateTimeBetween('-1 year'),
            'content' =>  [
                "type" => "doc",
                "content" => [
                    [
                        "type" => "paragraph",
                        "content" => [
                            [
                                "type" => "text",
                                "text" => "dsfdsfdsafasf",
                            ],
                        ],
                        "attrs" => [
                            "textAlign" => "start",
                        ],
                    ],
                ],
            ],
        ];
    }
}
