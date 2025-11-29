<?php

namespace App\Filament\Pages;

use App\Livewire\UsersOverviewWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected int | string | array $columnSpan = 'full';

    public function getColumns(): int | array
    {
        return 3;
    }

    public function getWidgets(): array
    {
        return [
            UsersOverviewWidget::class
        ];
    }
}
