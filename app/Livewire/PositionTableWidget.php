<?php

namespace App\Livewire;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Position;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;


class PositionTableWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public static function getQuery(): Builder
    {
        return Position::query()->where('team_id', Filament::getTenant()->id);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(static::getQuery())
            ->heading('Cargos')
            ->searchable(false)
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->label('Cargo')
                    ->searchable()
                    ->sortable()
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if ($state === 'Membro') {
                            return 'Cargo Membro é obrigatório existir!!';
                        }

                        return null;
                    }),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->html()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->tooltip(fn(Model $record): string => match ($record->status) {
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
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->recordActions([
                EditAction::make()
                    ->iconButton()
                    ->hidden(fn(Model $record): bool => $record->isMember())
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome do Cargo')
                            ->required(),
                        RichEditor::make('description')
                            ->label('Descrição'),
                        Toggle::make('status')
                            ->required(),
                    ]),
                DeleteAction::make()
                    ->iconButton()
                    ->hidden(fn(Model $record): bool => $record->isMember())
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
