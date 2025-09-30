<?php

namespace Database\Seeders;

use App\Models\Issues;
use App\Models\Property;
use Illuminate\Database\Seeder;

final class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()
            ->each(
                fn(Property $obj) => Issues::factory()
                    ->count(5)
                    ->create(['property_id' => $obj->id]),
            );
    }
}
