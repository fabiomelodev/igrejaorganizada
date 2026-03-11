<?php

namespace App\Filament\Resources\Participants\Schemas;

use App\Models\Member;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Builder;

class ParticipantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Wizard::make([
                    Step::make('Tipo')
                        ->schema([
                            Select::make('is_internal')
                                ->label('Participante é membro da igreja?')
                                ->live()
                                ->required()
                                ->afterStateUpdated(function ($state, Set $set) {
                                    if ($state == 0) {
                                        $set('name', '');

                                        $set('birthdate', '');

                                        $set('email', '');

                                        $set('phone', '');
                                    }
                                })
                                ->options([
                                    1 => 'Sim',
                                    0 => 'Não'
                                ]),
                        ]),
                    Step::make('Dados')
                        ->columns(2)
                        ->schema([
                            Select::make('member_id')
                                ->label('Membro')
                                ->relationship('member', 'name')
                                ->visible(fn(Get $get): bool => (int) $get('is_internal') ?? false)
                                ->live()
                                ->columnSpanFull()
                                ->afterStateUpdated(function ($state, Set $set) {
                                    $member = Member::find($state);

                                    $set('name', $member->name);

                                    $set('birthdate', $member->birthdate);

                                    $set('email', $member->email);

                                    $set('phone', $member->phone);
                                }),
                            TextInput::make('name')
                                ->label('Nome')
                                ->disabled(fn(Get $get): bool => (int) $get('is_internal') ?? false)
                                ->columnSpanFull()
                                ->required(),
                            DatePicker::make('birthdate')
                                ->label('Data de Nascimento')
                                ->disabled(fn(Get $get): bool => (int) $get('is_internal') ?? false)
                                ->columnSpanFull()
                                ->required(),
                            TextInput::make('email')
                                ->label('E-mail')
                                ->email()
                                ->disabled(fn(Get $get): bool => (int) $get('is_internal') ?? false)
                                ->columnSpan(1),
                            TextInput::make('phone')
                                ->label('Telefone')
                                ->tel()
                                ->disabled(fn(Get $get): bool => (int) $get('is_internal') ?? false)
                                ->columnSpan(1),
                            Toggle::make('is_active')
                                ->label('Ativo')
                                ->inline(false)
                                ->onColor('success')
                                ->offColor('danger')
                                ->default(true)
                                ->hiddenOn('create')
                                ->required()
                        ]),
                    Step::make('Responsável')
                        ->schema([
                            Select::make('responsible_id')
                                ->label('Responsável')
                                ->relationship('responsible', 'name', fn(Builder $query): Builder => $query->where('team_id', Filament::getTenant()->id))
                                ->createOptionForm([
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('name')
                                                ->label('Nome')
                                                ->columnSpanFull()
                                                ->required(),
                                            TextInput::make('email')
                                                ->label('E-mail (Opcional)')
                                                ->columnSpanFull()
                                                ->email(),
                                            TextInput::make('phone')
                                                ->label('Telefone')
                                                ->tel()
                                                ->columnSpanFull()
                                                ->required(),
                                            TextInput::make('address')
                                                ->label('Endereço')
                                                ->required(),
                                            TextInput::make('address_number')
                                                ->label('Número')
                                                ->required(),
                                            TextInput::make('kinship')
                                                ->label('Parentesco')
                                                ->placeholder('Ex: Mãe')
                                                ->columnSpanFull()
                                                ->required()
                                        ])
                                ]),
                        ]),
                    Step::make('Saúde')
                        ->columns(2)
                        ->schema([
                            RichEditor::make('health_observations')
                                ->label('Observações de Saúde (Opcional)')
                                ->columnSpanFull(),
                            FileUpload::make('health_reports')
                                ->label('Laudos (Opcional)')
                                ->helperText('Permitido carregar mais de uma imagem!')
                                ->multiple()
                                ->image()
                                ->columnSpanFull()
                        ]),
                ]),
            ]);
    }
}
