<?php

namespace App\Console\Commands;

use App\Models\Expanse;
use App\Models\RecurringCharges;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class GenerateExpanses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-expanses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        RecurringCharges::query()
            ->where(function ($query): void {
                $query->where(function ($query): void {
                    $query->where('interval', 'month')->where('interval_at', now()->format('d'));
                })->orWhere(function ($query): void {
                    $query->where('interval', 'week')->where('interval_at', now()->dayOfWeek);
                });
            })->where('execute_at', now()->format('H:i:00'))
            ->each(function (RecurringCharges $obj): void {
                $expanse = Expanse::create([
                    'name' => $obj->title,
                    'amount' => $obj->amount,
                    'lease_id' => $obj->lease_id,
                    'is_paid' => false,
                    'due_date' => now()->addDays($obj->due_date_in_days),
                    'description' => $obj->description,
                ]);
                Log::info('expanse', [$expanse]);
            });

    }
}
