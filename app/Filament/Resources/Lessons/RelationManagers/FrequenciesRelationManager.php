<?php

namespace App\Filament\Resources\Lessons\RelationManagers;

use App\Filament\Resources\Frequencies\FrequencyResource;
use App\Models\Frequency;
use App\Models\Member;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FrequenciesRelationManager extends RelationManager
{
    protected static string $relationship = 'frequencies';

    protected static ?string $relatedResource = FrequencyResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('createPosition')
                    ->label('Frequência')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Nova Frequência')
                    ->modalSubmitActionLabel('Criar')
                    ->visible(fn(): bool => $this->getOwnerRecord()->progress == 'course' ? true : false)
                    ->schema([
                        DatePicker::make('date')
                            ->label('Data')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $data['lesson_id'] = $this->getOwnerRecord()->id;

                        Frequency::create($data);
                    })
                    ->successNotificationTitle('Frequência criada com sucesso!'),
            ])
            ->heading('Frequências')
            ->description("Orientação: Registre as frequências dos alunos neste espaço. Estas informações correspondem à classe {$this->getOwnerRecord()->name}.")
            ->emptyStateHeading(fn(): string => $this->getOwnerRecord()->progress != 'course' ? 'Não é possível cadastrar frequências!' : '')
            ->emptyStateDescription(fn(): string => $this->getOwnerRecord()->progress != 'course' ? 'Altere a classe para cursando e continue cadastrando!' : '')
            ->searchable(false)
            ->paginated(false)
            ->columns([
                TextColumn::make('date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('lesson.name')
                    ->label('Classe')
                    ->searchable(),
                TextColumn::make('students')
                    ->label('Alunos presentes')
                    ->formatStateUsing(fn(Model $record): string => (string) "{$record->students()->count()} aluno(s)"),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton()
                    ->modalHeading('Editar Frequência')
                    ->schema(function (Frequency $record): array {
                        return [
                            DatePicker::make('date')
                                ->label('Data'),
                            CheckboxList::make('students')
                                ->label('Alunos')
                                ->relationship(
                                    'students',
                                    'name',
                                    fn(Builder $query): Builder => $query->whereNot('members.id', $this->getOwnerRecord()->teacher_id)
                                )
                                ->getOptionLabelFromRecordUsing(fn(Member $record): string => "{$record->name}, " . Carbon::parse($record->birthdate)->age . ' anos'),
                        ];
                    }),
                DeleteAction::make()
                    ->iconButton(),
            ]);
    }
}
