<?php

namespace App\Filament\Resources\Modalities;

use App\Filament\Resources\Modalities\Pages\CreateModality;
use App\Filament\Resources\Modalities\Pages\EditModality;
use App\Filament\Resources\Modalities\Pages\ListModalities;
use App\Filament\Resources\Modalities\Schemas\ModalityForm;
use App\Filament\Resources\Modalities\Tables\ModalitiesTable;
use App\Models\Modality;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ModalityResource extends Resource
{
    protected static ?string $model = Modality::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PuzzlePiece;

    protected static ?string $recordTitleAttribute = 'Modality';

    protected static ?string $label = 'Modalidade';

    protected static ?string $pluralLabel = 'Modalidades';

    protected static string|UnitEnum|null $navigationGroup = 'Projetos';

    public static function shouldRegisterNavigation(): bool
    {
        return Filament::getTenant()->slug == 'geral' ? false : true;
    }

    public static function form(Schema $schema): Schema
    {
        return ModalityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModalitiesTable::configure($table);
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
            'index' => ListModalities::route('/'),
            'create' => CreateModality::route('/create'),
            'edit' => EditModality::route('/{record}/edit'),
        ];
    }
}
