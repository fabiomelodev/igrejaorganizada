<?php

namespace App\Filament\Resources\Cults\Tables;

use App\Helpers\DateHelper;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CultsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchable()
            ->columns([
                TextColumn::make('name')
                    ->label('Culto')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('week')
                    ->label('Semana')
                    ->formatStateUsing(fn($state) => DateHelper::getWeek($state))
                    ->sortable(),
                TextColumn::make('start_time')
                    ->label('Horário')
                    ->formatStateUsing(fn(Model $record): string => "{$record->start_time} | {$record->end_time}"),
                TextColumn::make('status')
                    ->tooltip(fn($record): string => match ($record->status) {
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
                    ->formatStateUsing(fn() => '')
                    ->color(fn(string $state): string => match ((int) $state) {
                        1 => 'success',
                        0 => 'danger',
                        default => ''
                    }),
            ])
            ->filters([
                SelectFilter::make('week')
                    ->label('Semana')
                    ->options(DateHelper::getWeeks()),
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton(),
                DeleteAction::make()
                    ->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
