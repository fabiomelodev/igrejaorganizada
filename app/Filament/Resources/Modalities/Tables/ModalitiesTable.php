<?php

namespace App\Filament\Resources\Modalities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ModalitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('shedule')
                    ->label('Agenda'),
                TextColumn::make('max_capacity')
                    ->label('Capacidade Máxima')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('project.name')
                    ->label('Projeto')
                    ->searchable(),
                TextColumn::make('is_active')
                    ->label('Ativo')
                    ->tooltip(fn(Model $record): string => match ($record->is_active) {
                        1 => 'Ativo',
                        0 => 'Inativo',
                        default => ''
                    })
                    ->icon(function (TextColumn $column) {
                        return match ((int) $column->getState()) {
                            1 => Heroicon::Check,
                            0 => Heroicon::XMark,
                            default => null,
                        };
                    })
                    ->iconPosition(IconPosition::After)
                    ->badge()
                    ->formatStateUsing(fn(): string => '')
                    ->color(fn(string $state): string => match ((int) $state) {
                        1 => 'success',
                        0 => 'danger',
                        default => null
                    }),

                TextColumn::make('created_at')
                    ->label('Criado Em')
                    ->dateTime('d/m/Y')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton(),
                DeleteAction::make()
                    ->iconButton()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
