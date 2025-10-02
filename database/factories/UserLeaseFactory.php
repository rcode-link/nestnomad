<?php

namespace Database\Factories;

use App\Models\Lease;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserLease>
 */
final class UserLeaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $lease = Lease::factory()->create();
        return [
            'user_id' => $user->id,
            'tenant_name' => $user->name,
            'lease_id' => $lease->id,

        ];
    }
}
