<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamForm
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
                            ->disabled()
                            ->hiddenOn('create'),
                        Fieldset::make('Super Admin')
                            ->visible(fn() => auth()->user()->isSuperAdmin())
                            ->schema([
                                Select::make('plan_id')
                                    ->label('Plano')
                                    ->relationship('plan', 'name')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
