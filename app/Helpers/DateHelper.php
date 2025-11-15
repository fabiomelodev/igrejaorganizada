<?php

namespace App\Helpers;

class DateHelper
{
    public static function getWeeks(): array
    {
        return [
            'sunday' => 'Domingo',
            'monday' => 'Segunda',
            'tuesday' => 'Terça',
            'wednesday' => 'Quarta',
            'thursday' => 'Quinta',
            'friday' => 'Sexta',
            'saturday' => 'Sábado'
        ];
    }

    public static function getWeek(string $week): string
    {
        return static::getWeeks()[$week];
    }
}
