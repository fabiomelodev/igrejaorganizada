<?php

namespace App\Filament\Resources\Members\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome Completo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),
                TextColumn::make('position.name')
                    ->label('Cargo')
                    ->badge()
                    ->searchable(),
                TextColumn::make('is_active')
                    ->label('Ativo')
                    ->tooltip(fn($record): string => match ($record->is_active) {
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
                TextColumn::make('created_at')
                    ->label('Criado Em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('email')
                    ->schema([
                        TextInput::make('email')
                            ->label('E-mail')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['email'],
                                fn(Builder $query, $email): Builder => $query->whereLike('email', "%{$email}%")
                            );
                    }),
                SelectFilter::make('position.name')
                    ->label('Cargo')
                    ->relationship('position', 'name', fn(Builder $query): Builder => $query->isActive()->where('team_id', Filament::getTenant()->id))
                    ->options([
                        '1' => 'Ativo',
                        '0' => 'Inativo',
                    ]),
                SelectFilter::make('is_active')
                    ->label('Ativo')
                    ->options([
                        '1' => 'Ativo',
                        '0' => 'Inativo',
                    ])
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
