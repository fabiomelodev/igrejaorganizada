<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserForm
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
                            ->helperText('Este email será usado para login no sistema')
                            ->email()
                            ->required(),
                        TextInput::make('password')
                            ->label('Senha')
                            ->password()
                            ->revealable(filament()->arePasswordsRevealable())
                            ->required()
                            ->rule(Password::default())
                            ->showAllValidationMessages()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            // ->same('passwordConfirmation')
                            ->validationAttribute(__('filament-panels::auth/pages/register.form.password.validation_attribute'))
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->disabled()
                            ->displayFormat('d/m/Y H:i')
                            ->hiddenOn('create'),
                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->saveRelationshipsUsing(function (Model $record, $state) {
                                $record->roles()->syncWithPivotValues($state, [config('permission.column_names.team_foreign_key') => getPermissionsTeamId()]);
                            })
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        // Select::make('roles')
                        //     ->label('Função')
                        //     ->relationship('roles', 'name', function (Builder $query): Builder {
                        //         if (Auth::user()->isAdmin()) {
                        //             return $query->where('name', '!=', 'super_admin');
                        //         }

                        //         return $query;
                        //     }),
                        Toggle::make('status')
                            ->required(),
                    ])
            ]);
    }
}
