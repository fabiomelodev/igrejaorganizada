<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MemberForm
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
                            ->label('Nome completo')
                            ->required(),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel(),
                        DatePicker::make('birthdate')
                            ->label('Data de nascimento')
                            ->displayFormat('d/m/Y'),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->displayFormat('d/m/Y')
                            ->hiddenOn('create')
                            ->disabled(),
                        Select::make('gender')
                            ->label('Gênero')
                            ->options(['masculine' => 'Masculino', 'feminine' => 'Feminino'])
                            ->default('masculine')
                            ->required(),
                        Select::make('position_id')
                            ->label('Cargo')
                            ->relationship('position', 'name', fn(Builder $query): Builder => $query->active()->where('team_id', Filament::getTenant()->id))
                            ->required(),
                        Toggle::make('status')
                            ->required(),
                    ]),
                Section::make('Endereço')
                    ->columnSpan(9)
                    ->schema([
                        TextInput::make('address')
                            ->label('Endereço')
                            ->columnSpan('full')
                    ])
            ]);
    }
}
