<?php

namespace App\Filament\Resources\Schools\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Section::make()
                    ->columnSpan('9')
                    ->schema([
                        TextInput::make('name')
                            ->label('Escola')
                            ->required(),
                        RichEditor::make('description')
                            ->label('Descrição')
                    ]),
                Section::make()
                    ->columnSpan('3')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->disabled()
                            ->displayFormat('d/m/Y H:i')
                            ->hiddenOn('create'),
                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                            ->required()
                    ]),

            ]);
    }
}
