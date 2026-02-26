<?php

namespace App\Filament\Resources\Modalities\Schemas;

use App\Helpers\DateHelper;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModalityForm
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
                            ->label('Nome Completo')
                            ->required(),
                        RichEditor::make('description')
                            ->label('Descrição'),
                        Repeater::make('schedules')
                            ->label('Horários')
                            ->columns(2)
                            ->schema([
                                Select::make('day')
                                    ->label('Dia da Semana')
                                    ->options(DateHelper::getWeeks())
                                    ->required(),
                                TextInput::make('schedule')
                                    ->label('Horário')
                                    ->placeholder('Ex: 08h00')
                                    ->required()
                            ]),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Criado Em')
                            ->displayFormat('d/m/Y')
                            ->hiddenOn('create')
                            ->disabled(),
                        TextInput::make('max_capacity')
                            ->label('Capacidade Máxima')
                            ->numeric(),
                        Select::make('project_id')
                            ->label('Projeto')
                            ->relationship('project', 'name')
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger')
                            ->required(),
                    ]),
            ]);
    }
}
