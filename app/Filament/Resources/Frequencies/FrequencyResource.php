<?php

namespace App\Filament\Resources\Frequencies;

use App\Filament\Resources\Frequencies\Schemas\FrequencyForm;
use App\Filament\Resources\Frequencies\Schemas\FrequencyInfolist;
use App\Filament\Resources\Frequencies\Tables\FrequenciesTable;
use App\Models\Frequency;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FrequencyResource extends Resource
{
    protected static ?string $model = Frequency::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Frequency';

    protected static ?string $label = 'Frequência';

    protected static ?string $pluralLabel = 'Frequências';

    public static function form(Schema $schema): Schema
    {
        return FrequencyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FrequencyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FrequenciesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            // 'index' => ListFrequencies::route('/'),
            // 'create' => CreateFrequency::route('/create'),
            // 'view' => ViewFrequency::route('/{record}'),
            // 'edit' => EditFrequency::route('/{record}/edit'),
        ];
    }
}
