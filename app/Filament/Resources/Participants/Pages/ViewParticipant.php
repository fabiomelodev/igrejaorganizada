<?php

namespace App\Filament\Resources\Participants\Pages;

use App\Filament\Resources\Participants\ParticipantResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewParticipant extends ViewRecord
{
    protected static string $resource = ParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Grid::make(12)
                    ->schema([
                        Section::make('Dados')
                            ->columnSpan(9)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nome'),
                                TextEntry::make('birthdate')
                                    ->label('Data de Nascimento')
                                    ->datetime('d/m/Y'),

                            ]),
                        Section::make('Contato')
                            ->columnSpan(3)
                            ->schema([
                                TextEntry::make('email')
                                    ->label('E-mail'),
                                TextEntry::make('phone')
                                    ->label('Telefone'),

                            ]),
                    ]),
                Section::make('Saúde')
                    ->schema([
                        TextEntry::make('health_observations')
                            ->label('Observações'),
                        ImageEntry::make('health_reports')
                            ->label('Laudos'),
                    ]),
                Section::make('Responsável')
                    ->schema([
                        TextEntry::make('responsible.name')
                            ->label('Nome'),
                        TextEntry::make('responsible.phone')
                            ->label('Telefone'),
                        TextEntry::make('responsible.kinship')
                            ->label('Parentesco'),
                        TextEntry::make('responsible.address')
                            ->label('Endereço'),
                        TextEntry::make('responsible.address_number')
                            ->label('Número'),

                    ]),
            ]);
    }
}
