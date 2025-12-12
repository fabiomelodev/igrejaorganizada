<?php

namespace App\Filament\Resources\Deposits\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;


class DepositForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Section::make()
                    ->columnSpan(9)
                    ->columns(12)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->columnSpanFull()
                            ->required(),
                        RichEditor::make('description')
                            ->label('Descrição (opcional)')
                            ->columnSpanFull(),
                        Select::make('bank_id')
                            ->label('Banco')
                            ->relationship('bank', 'name')
                            ->columnSpan(4)
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Banco')
                                    ->required(),
                            ]),
                        Select::make('category_id')
                            ->label('Categoria')
                            ->relationship('category', 'name')
                            ->columnSpan(4)
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Categoria')
                                    ->required(),
                            ]),
                        Select::make('member_id')
                            ->label('Membro (Opcional)')
                            ->relationship('member', 'name')
                            ->columnSpan(4)
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        DatePicker::make('date')
                            ->label('Data de entrada')
                            ->displayFormat('d/m/Y')
                            ->required(),
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->required()
                            ->numeric(),
                        Select::make('payment_method_id')
                            ->label('Forma de pagamento')
                            ->relationship('paymentMethod', 'name')
                            ->required()
                    ]),
            ]);
    }
}
