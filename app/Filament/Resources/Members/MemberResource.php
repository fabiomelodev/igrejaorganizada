<?php

namespace App\Filament\Resources\Members;

use App\Constants\FeatureKey;
use App\Filament\Resources\Members\Pages\CreateMember;
use App\Filament\Resources\Members\Pages\EditMember;
use App\Filament\Resources\Members\Pages\ListMembers;
use App\Filament\Resources\Members\Schemas\MemberForm;
use App\Filament\Resources\Members\Schemas\MemberInfolist;
use App\Filament\Resources\Members\Tables\MembersTable;
use App\Models\Member;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'Member';

    protected static ?string $label = 'Membro';

    protected static ?string $pluralLabel = 'Membros';


    protected static string|UnitEnum|null $navigationGroup = 'Geral';

    public static function shouldRegisterNavigation(): bool
    {
        return Filament::getTenant()->slug == 'geral' ? false : true;
    }

    public static function canViewAny(): bool
    {
        return Filament::getTenant()->hasFeature(FeatureKey::MEMBER_MODULE);
    }

    // public static function canCreate(): bool
    // {
    //     $team = Filament::getTenant();

    //     return !$team->hasReachedLimit(FeatureKey::MEMBER_LIMIT);
    // }

    public static function form(Schema $schema): Schema
    {
        return MemberForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MemberInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MembersTable::configure($table);
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
            'index' => ListMembers::route('/'),
            'create' => CreateMember::route('/create'),
            'edit' => EditMember::route('/{record}/edit'),
        ];
    }
}
