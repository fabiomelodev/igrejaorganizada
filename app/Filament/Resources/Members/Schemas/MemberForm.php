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
                            ->label('Nome Completo')
                            ->required(),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel(),
                        DatePicker::make('birthdate')
                            ->label('Data de Nascimento')
                            ->displayFormat('d/m/Y'),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Criado Em')
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
                            ->relationship('position', 'name', fn(Builder $query): Builder => $query->isActive()->where('team_id', Filament::getTenant()->id))
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nome')
                                    ->required(),
                            ])
                            ->helperText('Crie novos cargos')
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                            ->required()
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
