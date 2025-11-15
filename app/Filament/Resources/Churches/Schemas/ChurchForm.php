<?php

namespace App\Filament\Resources\Churches\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ChurchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Section::make()
                    ->columnSpan(9)
                    ->schema([
                        TextInput::make('name')
                            ->label('Igreja')
                            ->required(),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->displayFormat('d/m/Y')
                            ->hiddenOn('create')
                            ->disabled(),
                        Select::make('user_id')
                            ->label('Responsável')
                            ->relationship('responsible', 'name', fn(Model $record) => $record->users())
                            ->disabled(fn(): bool => Auth::user()->isAdmin())
                            ->required(),
                        Toggle::make('status')
                            ->visible(fn() => Auth::user()->isSuperAdmin())
                            ->required(),
                    ])

            ]);
    }
}
