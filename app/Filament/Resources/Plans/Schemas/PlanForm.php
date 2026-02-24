<?php

namespace App\Filament\Resources\Plans\Schemas;

use App\Models\Feature;
use App\Models\Plan;
use App\Models\PlanFeature;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Section::make()
                    ->columnSpan(9)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),
                        Textarea::make('description')
                            ->label('Descrição'),
                        Repeater::make('features')
                            ->label('Recursos')
                            ->relationship('features')
                            ->columns(2)
                            ->schema([
                                Select::make('feature_id')
                                    ->label('Recurso')
                                    ->options(Feature::all()->pluck('name', 'id'))
                                    ->required()
                                    ->distinct()
                                    ->live()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                                TextInput::make('value')
                                    ->required()
                                    ->dehydrated(true)
                                    ->label(function (Get $get) {
                                        $feature = Feature::find($get('feature_id'));

                                        return $feature && $feature->type === 'limit' ? 'Quantidade Limite' : 'Status (1 ou 0)';
                                    })
                                    ->numeric(function (Get $get) {
                                        $feature = Feature::find($get('feature_id'));

                                        return $feature && $feature->type === 'limit';
                                    })
                            ])
                            ->saveRelationshipsUsing(function ($record, $state) {
                                $syncData = [];

                                foreach ($state as $item) {
                                    if (isset($item['feature_id'])) {
                                        $syncData[$item['feature_id']] = ['value' => $item['value']];
                                    }
                                }

                                $record->features()->sync($syncData);
                            })
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->hiddenOn('create')
                    ->schema([
                        TextInput::make('price')
                            ->label('Preço')
                            ->prefix('R$')
                            ->required(),
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->hiddenOn('create')
                            ->disabled()
                    ]),
            ]);
    }
}
