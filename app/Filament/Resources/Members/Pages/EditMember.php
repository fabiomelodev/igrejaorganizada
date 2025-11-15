<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Models\Church;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EditMember extends EditRecord
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    // public function form(Schema $schema): Schema
    // {
    //     return $schema
    //         ->columns(12)
    //         ->components([
    //             Section::make()
    //                 ->columnSpan(9)
    //                 ->schema([
    //                     TextInput::make('name')
    //                         ->label('Nome completo')
    //                         ->required(),
    //                     TextInput::make('email')
    //                         ->label('E-mail')
    //                         ->email()
    //                         ->required(),
    //                     TextInput::make('phone')
    //                         ->label('Telefone')
    //                         ->tel(),
    //                     DatePicker::make('birthdate')
    //                         ->label('Data de nascimento')
    //                         ->displayFormat('d/m/Y'),
    //                 ]),
    //             Section::make()
    //                 ->columnSpan(3)
    //                 ->schema([
    //                     DatePicker::make('created_at')
    //                         ->label('Criado em')
    //                         ->displayFormat('d/m/Y')
    //                         ->disabled(),
    //                     Select::make('gender')
    //                         ->label('Gênero')
    //                         ->options(['masculine' => 'Masculino', 'feminine' => 'Feminino'])
    //                         ->default('masculine')
    //                         ->required(),
    //                     Select::make('position_id')
    //                         ->label('Cargo')
    //                         ->relationship('position', 'name', fn(Builder $query): Builder => $query->churchCurrent())
    //                         ->required(),
    //                     Toggle::make('status')
    //                         ->required(),
    //                 ]),
    //             Section::make('Endereço')
    //                 ->columnSpan(9)
    //                 ->schema([
    //                     TextInput::make('address')
    //                         ->label('Endereço')
    //                         ->columnSpan('full')
    //                 ])
    //         ]);
    // }
}
