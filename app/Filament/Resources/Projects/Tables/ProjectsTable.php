<?php

namespace App\Filament\Resources\Projects\Tables;

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

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('is_active')
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
                    ->label('Criado em')
                    ->dateTime('d/m/y')
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Ativo')
                    ->options([
                        '1' => 'Ativo',
                        '0' => 'Inativo',
                    ]),
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
