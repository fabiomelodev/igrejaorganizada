<?php

namespace App\Filament\Resources\Cults\Schemas;

use App\Helpers\DateHelper;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CultForm
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
                        TextInput::make('name')
                            ->label('Culto')
                            ->columnSpanFull()
                            ->required(),
                        Select::make('week')
                            ->label('Semana')
                            ->columnSpanFull()
                            ->options(DateHelper::getWeeks())
                            ->required(),
                        TimePicker::make('start_time')
                            ->label('Horário de início')
                            ->displayFormat('H:i:s')
                            ->columnSpan(1)
                            ->required(),
                        TimePicker::make('end_time')
                            ->label('Horário de término')
                            ->columnSpan(1)
                            ->required(),
                    ]),
                Section::make()
                    ->columnSpan('3')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->disabled()
                            ->displayFormat('d/m/Y H:i')
                            ->hiddenOn('create'),
                        Toggle::make('status')
                            ->required(),
                    ]),
            ]);
    }
}
