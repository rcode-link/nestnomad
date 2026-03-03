<?php

namespace App\Filament\Pages;

use App\Enums\ChargeCategory;
use App\Enums\UtilityType;
use App\Models\Expanse;
use App\Models\Lease;
use App\Models\Property;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;

final class AddBill extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedPlusCircle;

    protected string $view = 'filament.pages.add-bill';

    public ?array $data = [];

    public static function getNavigationLabel(): string
    {
        return __('filament.add_bill.title');
    }

    public function getTitle(): string
    {
        return __('filament.add_bill.title');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('property_id')
                    ->label(__('filament.properties.single'))
                    ->options(fn () => Property::query()->myProperty()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('name')
                    ->label(__('filament.charges.fields.category'))
                    ->options(ChargeCategory::getOptions())
                    ->default(ChargeCategory::RENT->value)
                    ->live()
                    ->required(),
                Select::make('utility_type')
                    ->label(__('filament.charges.fields.utility_type'))
                    ->options(UtilityType::getOptions())
                    ->visible(fn ($get) => $get('name') === ChargeCategory::UTILITIES->value)
                    ->required(fn ($get) => $get('name') === ChargeCategory::UTILITIES->value),
                TextInput::make('description')
                    ->label(__('filament.charges.fields.description'))
                    ->hidden(fn ($get) => $get('name') === ChargeCategory::UTILITIES->value),
                TextInput::make('amount')
                    ->label(__('filament.charges.fields.amount'))
                    ->numeric()
                    ->step(0.01)
                    ->inputMode('decimal')
                    ->required(),
                DatePicker::make('due_date')
                    ->label(__('filament.charges.fields.due_date'))
                    ->required(),
                Checkbox::make('generate_pdf')
                    ->translateLabel(),
                Checkbox::make('share_with_tenants')
                    ->default(true)
                    ->translateLabel(),
                FileUpload::make('bill')->storeFile(false),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $amount = (int) ($data['amount'] * 100);
        $leases = Lease::query()
            ->active()
            ->where('property_id', $data['property_id'])
            ->pluck('id');

        if ($leases->isEmpty()) {
            Notification::make()
                ->title(__('filament.add_bill.no_leases'))
                ->danger()
                ->send();

            return;
        }

        $perLeaseAmount = (int) ($amount / $leases->count());

        $temporaryPath = null;
        $originalName = null;
        if ($data['bill'] ?? null) {
            $temporaryPath = $data['bill']->store('temp', 'public');
            $originalName = $data['bill']->getClientOriginalName();
        }

        foreach ($leases as $leaseId) {
            $model = Expanse::create([
                'name' => $data['name'],
                'lease_id' => $leaseId,
                'amount' => $perLeaseAmount,
                'is_private' => ! ($data['share_with_tenants'] ?? true),
                'due_date' => $data['due_date'],
                'description' => $data['name'] === ChargeCategory::UTILITIES->value
                    ? ($data['utility_type'] ?? null)
                    : ($data['description'] ?? null),
            ]);

            if ($data['generate_pdf'] ?? false) {
                $model->generatePdf();
            }

            if ($temporaryPath) {
                $model->addMediaFromDisk($temporaryPath, 'public')
                    ->preservingOriginal()
                    ->usingFileName($originalName)
                    ->toMediaCollection('bill', 's3');
            }
        }

        if ($temporaryPath) {
            Storage::delete($temporaryPath);
        }

        Notification::make()
            ->title(__('filament.add_bill.success'))
            ->success()
            ->send();

        $this->form->fill();
    }
}
