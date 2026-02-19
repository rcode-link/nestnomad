<?php

namespace App\Filament\Resources\Issues\Schemas;

use App\Enums\IssueStatus;
use App\Filament\Infolists\Components\CommentsEntry;
use App\Filament\Resources\Properties\PropertyResource;
use App\Models\Issues;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class IssuesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->columnSpanFull()
                            ->formatStateUsing(fn(string $state): string => IssueStatus::from($state)->getLabel())
                            ->icon(fn($state) => IssueStatus::from($state)->getIcon())
                            ->color(fn($state) => IssueStatus::from($state)->getColor()),
                        TextEntry::make('user.name'),
                        TextEntry::make('property.name')->label(__('filament.properties.single'))->url(fn(Issues $record) => PropertyResource::getUrl('view', ['record' => $record->property])),
                        TextEntry::make('property.address.placeName'),
                        TextEntry::make('created_at')
                            ->dateTime(),
                        Action::make('change_status')
                            ->label(__('filament.issues.actions.change_status'))
                            ->visible($schema->getRecord()->whereHas('property', fn($query) => $query->myProperty())->count() > 0)
                            ->schema([
                                Select::make('status')->options(IssueStatus::getOptions()),
                            ])->action(function ($data) use ($schema): void {
                                $schema->getrecord()->update($data);
                            }),
                    ]),
                Section::make()->schema([
                    RichContentRenderer::make($schema->getRecord()->content)
                        ->fileAttachmentsDisk('s3')
                        ->fileAttachmentsVisibility('private'),

                    Section::make("Comments")
                        ->contained(false)
                        ->schema([
                            RichEditor::make('comment_body')
                                ->required()
                                ->json()
                                ->fileAttachmentsDisk('s3')
                                ->fileAttachmentsDirectory('attachments')
                                ->fileAttachmentsVisibility('private')
                                ->toolbarButtons([
                                    'paragraph' => [
                                        'bold', 'italic', 'underline', 'link', 'attachFiles'],


                                ])
                                ->default(null)
                                ->columnSpanFull(),


                        ])->action(Action::make('submit_comment')
                        ->label('Submit')
                        ->action(function (array $data, $record): void {
                            // Handle form submission (e.g., create a new comment)
                            $record->comments()->create([
                                'author' => $data['comment_author'],
                                'body' => $data['comment_body'],
                            ]);
                        })),
                    //CommentsEntry::make('title')->hiddenLabel(),
                ])->columnSpan(2),
            ]);
    }
}
