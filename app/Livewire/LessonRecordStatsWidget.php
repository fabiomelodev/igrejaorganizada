<?php

namespace App\Livewire;

use App\Models\Lesson;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\StatCustom;
use Illuminate\Database\Eloquent\Model;

class LessonRecordStatsWidget extends StatsOverviewWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        $studentsCount = $this->record->students()->count();

        $frequencyLatestStudents = $this->record->frequencies()->latest()->first()->students()->count();

        return [
            StatCustom::make('Aluno(s) Matriculado(s)', $studentsCount),
            StatCustom::make('Média de Chamadas', Lesson::presenceAverage($this->record) . '%'),
            StatCustom::make('Última Chamada', $frequencyLatestStudents),
        ];
    }
}
