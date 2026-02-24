<?php
namespace App\Traits;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;

trait CheckPlanLimits
{
    public function verifyLimit(string $featureKey): void
    {
        if (Filament::getTenant()->hasReachedLimit($featureKey)) {
            Notification::make()
                ->warning()
                ->title('Limite Atingido')
                ->body('Seu plano atual não permite mais registros deste tipo.')
                ->persistent()
                ->send();

            $this->redirect($this->getResource()::getUrl('index'));
        }
    }
}