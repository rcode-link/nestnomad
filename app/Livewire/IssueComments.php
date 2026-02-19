<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Issues;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Livewire\Component;

final class IssueComments extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public Issues $issue;

    public ?array $data = [];

    public function mount(Issues $issue): void
    {
        $this->issue = $issue;
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                RichEditor::make('text')
                    ->hiddenLabel()
                    ->placeholder(__('filament.comments.placeholder'))
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'link'],
                        ['bulletList', 'orderedList'],
                        ['attachFiles'],
                    ])
                    ->fileAttachmentsDisk('s3')
                    ->fileAttachmentsDirectory('comment-attachments')
                    ->fileAttachmentsVisibility('private')
                    ->required()
                    ->maxLength(5000),
            ])

            ->statePath('data');
    }

    public function commentsInfolist(Schema $schema): Schema
    {
        return $schema
            ->record($this->issue)
            ->schema([
                RepeatableEntry::make('comments')
                    ->hiddenLabel()
                    ->schema([
                        ImageEntry::make('commenter_avatar')
                            ->hiddenLabel()
                            ->circular()
                            ->imageSize(40)
                            ->state(fn(Comment $record) => $record->commenter?->getFirstMediaUrl('avatar', 'thumb'))
                            ->defaultImageUrl(fn(Comment $record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->commenter?->name ?? '?') . '&color=7F9CF5&background=EBF4FF')
                            ->grow(false),
                        TextEntry::make('commenter.name')
                            ->hiddenLabel()
                            ->weight('bold')
                            ->suffixAction(
                                Action::make('delete')
                                    ->icon('heroicon-o-trash')
                                    ->color('danger')
                                    ->size('xs')
                                    ->requiresConfirmation()
                                    ->visible(fn(Comment $record) => $record->commenter_id === auth()->id())
                                    ->action(fn(Comment $record) => $record->delete()),
                            ),
                        TextEntry::make('created_at')
                            ->hiddenLabel()
                            ->since()
                            ->color('gray')
                            ->size('xs'),
                        TextEntry::make('text')
                            ->hiddenLabel()
                            ->html()
                            ->prose()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public function addComment(): void
    {
        $state = $this->form->getState();

        $this->issue->comments()->create([
            'text' => $state['text'],
            'commenter_id' => auth()->id(),
            'commenter_type' => get_class(auth()->user()),
        ]);

        $this->form->fill();
        unset($this->commentsInfolist);
    }

    public function deleteComment(int $commentId): void
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->commenter_id !== auth()->id()) {
            return;
        }

        $comment->delete();
    }

    public function render()
    {
        return view('livewire.issue-comments');
    }
}
