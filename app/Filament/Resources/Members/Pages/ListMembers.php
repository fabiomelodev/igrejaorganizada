<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Livewire\MembersActiveCountWidget;
use App\Models\Position;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createPosition')
                ->label('Cargo')
                ->icon('heroicon-o-plus')
                ->modalHeading('Novo Cargo')
                ->modalSubmitActionLabel('Criar')
                ->schema([
                    TextInput::make('name')
                        ->label('Nome do Cargo')
                        ->required(),
                    RichEditor::make('description')
                        ->label('Descrição'),
                    Toggle::make('status')
                        ->required(),
                ])
                ->action(function (array $data) {
                    Position::create($data);
                })
                ->successNotificationTitle('Cargo criado com sucesso!'),
            CreateAction::make()
                ->label('Membro')
                ->icon('heroicon-o-plus')
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 3;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MembersActiveCountWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            \App\Livewire\PositionTableWidget::class,
        ];
    }
}
