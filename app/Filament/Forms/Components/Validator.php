<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use Closure;

class Validator extends Field
{
    protected string $view = 'filament.forms.components.validator';

    protected bool|Closure $condition = false;

    protected ?string $trueMessage = null;

    protected ?string $falseMessage = null;

    public function validate(bool|Closure $condition = true): static
    {
        $this->condition = $condition;

        return $this;
    }

    public function getValidade(): string|null
    {
        if ($this->condition) {
            return $this->trueMessage;
        }

        return $this->falseMessage;
    }

    public function trueMessage(string $message): static
    {
        $this->trueMessage = $message;

        return $this;
    }

    public function falseMessage(string $message): static
    {
        $this->falseMessage = $message;

        return $this;
    }
}
