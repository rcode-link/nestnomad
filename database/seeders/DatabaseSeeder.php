<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use App\Models\UserLease;
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
                Property::factory()->count(5),
                'property',
            )
            ->create([
                'email' => 'landlord@email.com',
            ]);

        UserLease::factory()->count(5)->create();
        $this->call(ExpansesSeeder::class);
        $this->call(IssueSeeder::class);
    }
}
