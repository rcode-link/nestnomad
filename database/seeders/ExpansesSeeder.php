<?php

namespace Database\Seeders;

use App\Enums\ChargeCategory;
use App\Models\Expanse;
use App\Models\Lease;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

final class ExpansesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lease::all()->each(function ($obj): void {

            $date = now();
            $model = Expanse::create([
                'name' => ChargeCategory::RENT,
                'amount' => rand(20000, 80000),
                'lease_id' => $obj->id,
                'created_at' => $date,
                'updated_at' => $date,
                'is_paid' => false,
                'due_date' => Carbon::parse($date)->setDay(15),
            ]);

            $elect = rand(30, 80) * 100;
            $model = Expanse::create([
                'name' => ChargeCategory::UTILITIES,
                'description' => 'Electricity',
                'amount' => $elect,
                'lease_id' => $obj->id,
                'created_at' => $date,
                'updated_at' => $date,
                'is_paid' => false,
                'due_date' => Carbon::parse($date)->setDay(25),
            ]);
            $water =  rand(10, 30) * 100;
            $model = Expanse::create([
                'name' => ChargeCategory::UTILITIES,
                'description' => 'Water',
                'amount' => $water,
                'lease_id' => $obj->id,
                'created_at' => $date,
                'updated_at' => $date,
                'is_paid' => false,
                'due_date' => Carbon::parse($date)->setDay(15),
            ]);


            for ($i = 0; $i < now()->month - 1; $i++) {
                $date = now()->setMonth($i + 1)->startOfMonth();

                $model = Expanse::create([
                    'name' => ChargeCategory::RENT,
                    'amount' => 50000,
                    'lease_id' => $obj->id,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'is_paid' =>  true,
                    'due_date' => Carbon::parse($date)->setDay(15),
                ]);

                $model->payment()->create([
                    'amount' => 50000,
                    'created_at' => Carbon::parse($date)->setDay(15),
                    'updated_at' => Carbon::parse($date)->setDay(15),
                ]);
                $elect = rand(30, 80) * ($i / 2) * 100;
                $model = Expanse::create([
                    'name' => ChargeCategory::UTILITIES,
                    'description' => 'Electricity',
                    'amount' => $elect,
                    'lease_id' => $obj->id,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'is_paid' =>  true,
                    'due_date' => Carbon::parse($date)->setDay(25),
                ]);

                $model->payment()->create([
                    'amount' => $elect,
                    'created_at' => Carbon::parse($date)->setDay(25),
                    'updated_at' => Carbon::parse($date)->setDay(25),
                ]);

                $water =  rand(10, 30) * 100;
                $model = Expanse::create([
                    'name' => ChargeCategory::UTILITIES,
                    'description' => 'Water',
                    'amount' => $water,
                    'lease_id' => $obj->id,
                    'created_at' => $date,
                    'is_paid' => true,
                    'updated_at' => $date,
                    'due_date' => Carbon::parse($date)->setDay(15),
                ]);
                $model->payment()->create([
                    'amount' => $water,
                    'created_at' => Carbon::parse($date)->setDay(25),
                    'updated_at' => Carbon::parse($date)->setDay(25),
                ]);



            }
        });
    }
}
