<?php

namespace App\Filament\Resources\Features;

use App\Filament\Resources\Features\Pages\CreateFeature;
use App\Filament\Resources\Features\Pages\EditFeature;
use App\Filament\Resources\Features\Pages\ListFeatures;
use App\Filament\Resources\Features\Schemas\FeatureForm;
use App\Filament\Resources\Features\Tables\FeaturesTable;
use App\Models\Feature;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FeatureResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model = Feature::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Feature';

    protected static ?string $label = 'Recurso';

    protected static ?string $pluralLabel = 'Recursos';

    protected static string|UnitEnum|null $navigationGroup = 'Planos e Recursos';

    public static function shouldRegisterNavigation(): bool
    {
        return Filament::getTenant()->slug == 'geral' ? true : false;
    }

    public static function form(Schema $schema): Schema
    {
        return FeatureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeaturesTable::configure($table);
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
            'index' => ListFeatures::route('/'),
            'create' => CreateFeature::route('/create'),
            // 'edit' => EditFeature::route('/{record}/edit'),
        ];
    }
}
