<?php

namespace Database\Seeders;

use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()
            ->has(
                Property::factory()
                    ->has(
                        Lease::factory()
                            ->count(1),
                        'lease',
                    )
                    ->count(5),
                'property',
            )
            ->create([
                'email' => 'landlord@email.com',
            ]);
        User::factory()
            ->has(
                Property::factory()
                    ->has(
                        Lease::factory()
                            ->count(1),
                        'lease',
                    )
                    ->count(5),
                'property',
            )->count(1500)->create();
        $this->call(ExpansesSeeder::class);
        $this->call(IssueSeeder::class);
    }
}
