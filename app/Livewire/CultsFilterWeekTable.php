<?php

namespace App\Livewire;

use App\Helpers\DateHelper;
use App\Models\Cult;
use Filament\Actions\BulkActionGroup;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CultsFilterWeekTable extends TableWidget
{
    protected int | string | array $columnSpan = 1;

    protected string | null $dayWeek = null;

    public function getQuery(): Builder
    {
        if (is_null($this->dayWeek)) {
            return Cult::query()->active();
        }

        if (Auth::user()->hasRole('super_admin')) {
            return Cult::query()->active()->where('week', $this->dayWeek)->withoutGlobalScopes();
        }

        return Cult::query()->active()->where('week', $this->dayWeek);
    }

    public function getHeading(): string
    {
        return 'Semana';
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading($this->getHeading())
            ->query($this->getQuery())
            ->columns([
                Stack::make([
                    TextColumn::make('name')
                        ->size(TextSize::ExtraSmall),
                    TextColumn::make('week')
                        ->formatStateUsing(fn($state) => DateHelper::getWeek($state))
                        ->badge()
                        ->size(TextSize::ExtraSmall),
                    TextColumn::make('start_time')
                        ->size(TextSize::ExtraSmall),
                    TextColumn::make('end_time')
                        ->size(TextSize::ExtraSmall),
                ])

            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
