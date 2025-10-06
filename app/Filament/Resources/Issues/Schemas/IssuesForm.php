<?php

namespace App\Filament\Resources\Issues\Schemas;

use App\Models\Property;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class IssuesForm
{
    public static function schema(?int $propery_id): array
    {

        return [
            TextInput::make('title')
                ->label(__('filament.issues.fields.title'))
                ->required(),
            Select::make('property_id')
                ->visible(null === $propery_id)
                ->label(__('filament.leases.fields.property'))
                ->searchable()
                ->getSearchResultsUsing(fn(string $search): array => Property::query()
                    ->iCanAccess()
                    ->where('name', 'like', "%{$search}%")
                    ->limit(50)
                    ->pluck('name', 'id')
                    ->all())
                ->getOptionLabelUsing(fn($value): ?string => Property::find($value)?->name),
            RichEditor::make('content')
                ->label(__('filament.issues.fields.content'))
                ->json()
                ->fileAttachmentsDisk('s3')
                ->fileAttachmentsDirectory('attachments')
                ->fileAttachmentsVisibility('private')
                ->floatingToolbars([
                    'paragraph' => [
                        'bold', 'italic', 'underline', 'strike', 'subscript', 'superscript',
                    ],
                    'heading' => [
                        'h1', 'h2', 'h3',
                    ],
                    'table' => [
                        'tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn',
                        'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow',
                        'tableMergeCells', 'tableSplitCell',
                        'tableToggleHeaderRow',
                        'tableDelete',
                    ],
                ])
                ->default(null)
                ->columnSpanFull(),


        ];
    }
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(self::schema(null));
    }
}
