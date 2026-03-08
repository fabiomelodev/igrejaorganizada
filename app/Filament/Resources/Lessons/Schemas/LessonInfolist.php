<?php

namespace App\Filament\Resources\Lessons\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LessonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('period')
                    ->badge(),
                TextEntry::make('time')
                    ->badge(),
                TextEntry::make('is_active')
                    ->badge(),
                TextEntry::make('school_id')
                    ->numeric(),
                TextEntry::make('member_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
