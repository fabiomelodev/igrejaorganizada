<?php

namespace App\Filament\Resources\Lessons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Classe')
                    ->searchable(),
                TextColumn::make('school.name')
                    ->label('Escola')
                    ->sortable(),
                TextColumn::make('period')
                    ->label('Período')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'quarter'     => 'Trimestre',
                        'not_defined' => 'Não definido',
                    }),
                TextColumn::make('time')
                    ->label('Horário')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'morning'   => 'Manhã',
                        'afternoon' => 'Tarde',
                        'night'     => 'Noite',
                    }),
                TextColumn::make('progress')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'finished'  => 'Finalizado',
                        'paused'    => 'Pausado',
                        'course'    => 'Em curso',
                        'preparing' => 'Preparando',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'finished'  => 'success',
                        'paused'    => 'warning',
                        'course'    => 'primary',
                        'preparing' => 'secondary',
                    }),
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
            ->searchable(false)
            ->filters([
                // SelectFilter::make('school.name')
                //     ->label('Escola')
                //     ->relationship('school', 'name')
                //     ->columnSpan(3),
                // SelectFilter::make('teacher.name')
                //     ->label('Professor(a)')
                //     ->relationship('teacher', 'name')
                //     ->columnSpan(3),
                // SelectFilter::make('period')
                //     ->label('Período')
                //     ->columnSpan(2)
                //     ->options([
                //         'quarter'     => 'Trimestre',
                //         'not_defined' => 'Não definido'
                //     ]),
                // SelectFilter::make('time')
                //     ->label('Horário')
                //     ->columnSpan(2)
                //     ->options([
                //         'night'       => 'Noite',
                //         'afternoon'   => 'Tarde',
                //         'morning'     => 'Manhã',
                //         'not_defined' => 'Não definido',
                //     ]),
                // SelectFilter::make('status')
                //     ->columnSpan(2)
                //     ->options([
                //         'finished'  => 'Finalizado',
                //         'paused'    => 'Pausado',
                //         'course'    => 'Curso',
                //         'preparing' => 'Preparando',
                //     ]),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersFormColumns(6)
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
