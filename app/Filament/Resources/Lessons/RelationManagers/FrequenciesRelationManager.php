<?php

namespace App\Filament\Resources\Lessons\RelationManagers;

use App\Filament\Resources\Frequencies\FrequencyResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FrequenciesRelationManager extends RelationManager
{
    protected static string $relationship = 'frequencies';

    protected static ?string $relatedResource = FrequencyResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                DatePicker::make('date')
                    ->label('Data')
                    ->required(),
                CheckboxList::make('students')
                    ->label('Marcar Presença')
                    ->relationship('students', 'name', fn(Builder $query): Builder => $query->whereHas('lessons')->isActive())
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
                    ->icon('heroicon-o-plus')
                    ->visible(function (): bool {
                        if ($this->getOwnerRecord()->is_active === 1 && $this->getOwnerRecord()->progress == 'course' && $this->getOwnerRecord()->students()->get()->exists()) {
                            return true;
                        }

                        return false;
                    }),
            ])
            ->heading('Chamadas')
            ->description("Orientação: Registre as chamadas dos alunos neste espaço. Estas informações correspondem à classe {$this->getOwnerRecord()->name}.")
            ->emptyStateHeading(function (): string {
                if ($this->getOwnerRecord()->is_active === 0) {
                    return 'Ative a turma para cadastrar chamadas!';
                }

                if ($this->getOwnerRecord()->progress != 'course') {
                    return 'Não é possível cadastrar chamadas!';
                }

                if ($this->getOwnerRecord()->students()->get()->isEmpty()) {
                    return 'Matricule os alunos para cadastrar chamadas!';
                }

                return '';
            })
            ->emptyStateDescription(fn(): string => $this->getOwnerRecord()->progress != 'course' ? 'Altere a classe para cursando e continue cadastrando!' : '')
            ->searchable(false)
            ->paginated(false)
            ->columns([
                TextColumn::make('date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('totalStudents')
                    ->label('Alunos Presentes')
                    ->formatStateUsing(fn(string $state): string => "{$state} aluno(s)"),
                TextColumn::make('created_at')
                    ->label('Criado Em')
                    ->date('d/m/Y')
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton(),
                DeleteAction::make()
                    ->iconButton(),
            ]);
    }
}
