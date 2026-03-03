<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Models\Review;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

final class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament.reviews.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('rating')
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('filament.reviews.fields.reviewer')),
                TextColumn::make('rating')
                    ->label(__('filament.reviews.fields.rating'))
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state >= 4 => 'success',
                        $state >= 3 => 'warning',
                        default => 'danger',
                    }),
                TextColumn::make('comment')
                    ->label(__('filament.reviews.fields.comment'))
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label(__('filament.reviews.fields.date'))
                    ->date(),
            ])
            ->headerActions([
                Action::make('create')
                    ->label(__('filament.reviews.actions.create'))
                    ->schema([
                        Select::make('rating')
                            ->label(__('filament.reviews.fields.rating'))
                            ->options([
                                1 => '1',
                                2 => '2',
                                3 => '3',
                                4 => '4',
                                5 => '5',
                            ])
                            ->required(),
                        Textarea::make('comment')
                            ->label(__('filament.reviews.fields.comment'))
                            ->rows(3),
                    ])
                    ->action(function (array $data): void {
                        $this->ownerRecord->reviews()->create([
                            'user_id' => auth()->id(),
                            'rating' => $data['rating'],
                            'comment' => $data['comment'] ?? null,
                            'review_type' => 'apartment',
                        ]);
                    }),
            ]);
    }
}
