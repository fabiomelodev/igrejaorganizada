<?php

namespace App\Filament\Resources\Features\Schemas;

use App\Constants\FeatureKey;
use Dom\Text;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Section::make()
                    ->columnSpan(9)
                    ->columns(2)
                    ->schema([
                        Select::make('key')
                            ->label('Chave')
                            ->options(FeatureKey::listUpdated())
                            ->required()
                            ->unique(),
                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'boolean' => 'Booleano',
                                'limit' => 'Limite',
                            ])
                            ->required(),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->hiddenOn('create')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->disabled()
                    ]),
            ]);
    }
}
