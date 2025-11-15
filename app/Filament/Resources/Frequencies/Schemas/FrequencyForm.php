<?php

namespace App\Filament\Resources\Frequencies\Schemas;

use App\Models\Member;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class FrequencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema;

        // return $schema
        //     ->columns(12)
        //     ->components([
        //         Section::make()
        //             ->columnSpan(9)
        //             ->components([
        //                 DatePicker::make('date')
        //                     ->label('Data')
        //                     ->required(),
        //             ]),
        //         Section::make()
        //             ->columnSpan(3)
        //             ->components([
        //                 Select::make('lesson_id')
        //                     ->label('Classe')
        //                     ->relationship('lesson', 'name', fn(Builder $query) => $query->where('status', 'course'))
        //                     ->required(),
        //             ])
        //     ]);
    }
}
