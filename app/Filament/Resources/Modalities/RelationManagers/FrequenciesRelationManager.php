<?php

namespace App\Filament\Resources\Modalities\RelationManagers;

use App\Filament\Resources\Frequencies\FrequencyResource;
use App\Models\Modality;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FrequenciesRelationManager extends RelationManager
{
    protected static string $relationship = 'frequencies';

    protected static ?string $relatedResource = FrequencyResource::class;

    protected static string $ownerModel = Modality::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                DatePicker::make('date')
                    ->label('Data')
                    ->required(),
                CheckboxList::make('participants')
                    ->label('Marcar Presença')
                    ->relationship('participants', 'name')
                    ->bulkToggleable()
                    ->required(),
            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->label(static::$relatedResource::getLabel())
                    ->icon('heroicon-o-plus'),
            ])
            ->heading('Chamadas')
            ->description("Orientação: Registre as chamadas dos alunos neste espaço. Estas informações correspondem à classe {$this->getOwnerRecord()->name}.")
            ->emptyStateHeading(fn(): string => $this->getOwnerRecord()->is_active != true ? 'Não é possível cadastrar chamadas!' : '')
            ->emptyStateDescription(fn(): string => $this->getOwnerRecord()->is_active != true ? 'Ative a modalidade e continue cadastrando!' : '')
            ->searchable(false)
            ->paginated(false)
            ->columns([
                TextColumn::make('date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('totalParticipants')
                    ->label('Participantes presentes')
                    ->formatStateUsing(fn(string $state): string => "{$state} participante(s)"),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton(),
                DeleteAction::make()
                    ->iconButton(),
            ]);
    }
}
