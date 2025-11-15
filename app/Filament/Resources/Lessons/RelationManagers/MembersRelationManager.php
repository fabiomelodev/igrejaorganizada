<?php

namespace App\Filament\Resources\Lessons\RelationManagers;

use App\Filament\Resources\Lessons\LessonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'registrations';

    protected static ?string $relatedResource = LessonResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
