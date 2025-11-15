<?php

namespace App\Filament\Resources\Churches;

use App\Filament\Resources\Churches\Pages\CreateChurch;
use App\Filament\Resources\Churches\Pages\EditChurch;
use App\Filament\Resources\Churches\Pages\ListChurches;
use App\Filament\Resources\Churches\Pages\ViewChurch;
use App\Filament\Resources\Churches\Schemas\ChurchForm;
use App\Filament\Resources\Churches\Schemas\ChurchInfolist;
use App\Filament\Resources\Churches\Tables\ChurchesTable;
use App\Models\Church;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class ChurchResource extends Resource
{
    protected static ?string $model = Church::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static ?string $label = 'Igreja';

    protected static ?string $pluralLabel = 'Igrejas';

    protected static ?string $recordTitleAttribute = 'Church';

    protected static string | UnitEnum | null $navigationGroup = 'Geral';

    public static function form(Schema $schema): Schema
    {
        return ChurchForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ChurchInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChurchesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public function getPagesIsSuperAdmin()
    {
        return [
            'index' => ListChurches::route('/'),
            'create' => CreateChurch::route('/create'),
            'view' => ViewChurch::route('/{record}'),
            'edit' => EditChurch::route('/{record}/edit'),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChurches::route('/'),
            'create' => CreateChurch::route('/create'),
            'view' => ViewChurch::route('/{record}'),
            'edit' => EditChurch::route('/{record}/edit'),
        ];
    }
}
