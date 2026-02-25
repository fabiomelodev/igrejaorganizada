<?php

namespace App\Filament\Resources\Cults;

use App\Constants\FeatureKey;
use App\Filament\Resources\Cults\Pages\CreateCult;
use App\Filament\Resources\Cults\Pages\EditCult;
use App\Filament\Resources\Cults\Pages\ListCults;
use App\Filament\Resources\Cults\Pages\ViewCult;
use App\Filament\Resources\Cults\Schemas\CultForm;
use App\Filament\Resources\Cults\Schemas\CultInfolist;
use App\Filament\Resources\Cults\Tables\CultsTable;
use App\Models\Cult;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CultResource extends Resource
{
    protected static ?string $model = Cult::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $label = 'Culto';

    protected static ?string $pluralLabel = 'Cultos';

    protected static ?string $recordTitleAttribute = 'Cult';

    protected static string|UnitEnum|null $navigationGroup = 'Eventos';

    public static function shouldRegisterNavigation(): bool
    {
        return Filament::getTenant()->slug == 'geral' ? false : true;
    }

    public static function canViewAny(): bool
    {
        return Filament::getTenant()->hasFeature(FeatureKey::CULT_MODULE);
    }

    public static function form(Schema $schema): Schema
    {
        return CultForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CultInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CultsTable::configure($table);
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
            'index' => ListCults::route('/'),
            'create' => CreateCult::route('/create'),
            'view' => ViewCult::route('/{record}'),
            'edit' => EditCult::route('/{record}/edit'),
        ];
    }
}
