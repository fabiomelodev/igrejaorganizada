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
        if ($this->record->is_active) {
            $studentsCount = $this->record->students()->isActive()->whereHas('lessons')->count();

            $frequencyLatestStudents = 'N/A';

            if ($this->record->frequencies()->exists()) {
                $frequencyLatestStudents = $this->record->frequencies()->latest()->first()->students()->isActive()->whereHas('lessons')->count();
            }

            return [
                StatCustom::make('Aluno(s) Matriculado(s)', $studentsCount),
                StatCustom::make('Média de Chamadas', Lesson::presenceAverage($this->record) . '%'),
                StatCustom::make('Última Chamada', $frequencyLatestStudents),
            ];
        }

        return [];
    }
}
