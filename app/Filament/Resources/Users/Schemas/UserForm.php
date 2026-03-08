<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
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
                            ->label('Nome Completo')
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
                            ->rule(Password::default())
                            ->showAllValidationMessages()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            // ->same('passwordConfirmation')
                            ->validationAttribute(__('filament-panels::auth/pages/register.form.password.validation_attribute'))
                            ->required(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        Select::make('roles')
                            ->label('Função')
                            ->relationship('roles', 'name', function (Builder $query): Builder {
                                return $query->where('name', '!=', 'super_admin');
                            })
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->required(),
                        DatePicker::make('created_at')
                            ->label('Criado Em')
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
                    ])
            ]);
    }
}
