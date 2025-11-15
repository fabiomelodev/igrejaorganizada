<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\Church;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Usuário')
                ->icon('heroicon-o-plus')
        ];
    }

    protected function getTableQuery(): Builder
    {
        // if (Auth::user()->isSuperAdmin()) {
        //     return static::getResource()::getEloquentQuery();
        // }

        // return static::getResource()::getEloquentQuery()->where('church_id', Filament::getTenant()->id);

        return Filament::getTenant()->users()->getQuery();
    }
}
