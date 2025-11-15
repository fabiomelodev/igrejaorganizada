<?php

namespace App\Filament\Resources\Frequencies\Pages;

use App\Filament\Resources\Frequencies\FrequencyResource;
use Carbon\Carbon;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EditFrequency extends EditRecord
{
    protected static string $resource = FrequencyResource::class;

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
    //         ->schema([
    //             Section::make()
    //                 ->columnSpan(9)
    //                 ->components([
    //                     DatePicker::make('date')
    //                         ->label('Data'),
    //                     CheckboxList::make('students')
    //                         ->label('Alunos')
    //                         ->relationship('students', 'name', function (Builder $query, Model $record) {
    //                             $query->whereHas('lessons', fn($q) => $q->where('lessons.id', $record->lesson_id));
    //                         })
    //                         ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name}, " . Carbon::parse($record->birthdate)->age . ' anos')
    //                 ]),
    //             Section::make()
    //                 ->columnSpan(3)
    //                 ->components([
    //                     DatePicker::make('created_at')
    //                         ->label('Criado em')
    //                         ->disabled(),
    //                     Select::make('lesson_id')
    //                         ->label('Classe')
    //                         ->relationship('lesson', 'name')
    //                         ->disabled()
    //                 ])
    //         ]);
    // }
}
