<?php

namespace App\Filament\Resources\Lessons\Schemas;

use App\Models\Member;
use App\Models\School;
use Carbon\Carbon;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Section::make()
                    ->columnSpan(9)
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Classe')
                            ->columnSpanFull()
                            ->required(),
                        RichEditor::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),
                        Select::make('school_id')
                            ->label('Escola')
                            ->relationship('school', 'name', fn(Builder $query): Builder => $query->active())
                            ->disabled(fn(): bool => !School::active()->exists())
                            ->columnSpan(1)
                            ->helperText(fn(): string => !School::active()->exists() ? 'Não existe escolas para vincular!' : '')
                            ->required(),
                        Select::make('teacher_id')
                            ->label('Professor(a)')
                            ->relationship('teacher', 'name', fn(Builder $query): Builder => $query->active())
                            ->disabled(fn(): bool => !Member::active()->exists())
                            ->columnSpan(1)
                            ->helperText(fn(): string => !Member::active()->exists() ? 'Não existe professores para matricular!' : '')
                            ->required(),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        Select::make('period')
                            ->label('Período')
                            ->default('not_defined')
                            ->required()
                            ->options([
                                'quarter'     => 'Trimestre',
                                'not_defined' => 'Não definido'
                            ]),
                        Select::make('time')
                            ->label('Horário')
                            ->default('not_defined')
                            ->required()
                            ->options([
                                'night'       => 'Noite',
                                'afternoon'   => 'Tarde',
                                'morning'     => 'Manhã',
                                'not_defined' => 'Não definido',
                            ]),
                        Select::make('progress')
                            ->label('Progresso')
                            ->default('preparing')
                            ->required()
                            ->options([
                                'finished'  => 'Finalizado',
                                'paused'    => 'Pausado',
                                'course'    => 'Curso',
                                'preparing' => 'Preparando',
                            ]),
                        Toggle::make('status')
                            ->required(),
                    ]),
            ]);
    }
}
