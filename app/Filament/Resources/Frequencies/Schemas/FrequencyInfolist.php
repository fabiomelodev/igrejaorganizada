<?php

namespace App\Filament\Resources\Frequencies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FrequencyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('lesson.name')
                    ->label('Lesson'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
