<?php

namespace App\Jobs;

use App\Models\Expanse;
use App\Models\Lease;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

final class CreateExpanse implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly array $data, private int $recordId) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->data;
        $amount = (int) ($data['amount'] * 100);
        $per_lease_amount = $amount;
        $leases = $data['leases'] ?? [];
        if ($data['split_equally_to_leases']) {
            $leases = Lease::query()
                ->active()
                ->where('property_id', $this->recordId)->pluck('id');

            $per_lease_amount = (int) ($amount / $leases->count());
        }
        foreach ($leases as $lease) {
            $model = Expanse::create([
                'name' => $data['name'],
                'lease_id' => $lease,
                'amount' => $per_lease_amount,
                'is_private' => ! $data['share_with_tenants'] ?? false,
                'due_date' => $data['due_date'],
            ]);

            if ($data['generate_pdf']) {
                $model->generatePdf();
            }

            if ($data['bill']) {
                $model->addMedia(storage_path('app/private/' . $data['bill']))->toMediaCollection('bill');
            }
        }
    }
}
