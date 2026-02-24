<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Pages\ListRecordsBase;
use App\Filament\Resources\Members\MemberResource;
use App\Livewire\MembersActiveCountWidget;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;

class ListMembers extends ListRecordsBase
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Membro')
                ->icon('heroicon-o-plus')
                // ->disabled(fn() => Filament::getTenant()->hasReachedLimit('member_limit'))
                ->tooltip(fn() => Filament::getTenant()->hasReachedLimit('member_limit') ? 'Limite atingido' : null)
        ];
    }

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Action::make('createPosition')
    //             ->label('Cargo')
    //             ->icon('heroicon-o-plus')
    //             ->modalHeading('Novo Cargo')
    //             ->modalSubmitActionLabel('Criar')
    //             ->schema([
    //                 TextInput::make('name')
    //                     ->label('Nome do Cargo')
    //                     ->required(),
    //                 RichEditor::make('description')
    //                     ->label('Descrição'),
    //                 Toggle::make('status')
    //                     ->required(),
    //             ])
    //             ->action(function (array $data) {
    //                 Position::create($data);
    //             })
    //             ->successNotificationTitle('Cargo criado com sucesso!'),
    //         CreateAction::make()
    //             ->label(static::$resource::getLabel())
    //             ->icon('heroicon-o-plus')
    //             ->hidden(fn() => !MemberResource::canCreate()),
    //     ];
    // }

    public function getHeaderWidgetsColumns(): int|array
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
