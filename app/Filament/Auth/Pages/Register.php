<?php

namespace App\Filament\Auth\Pages;

use App\Models\Church;
use App\Models\Churchable;
use App\Models\ChurchUser;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Register extends BaseRegister
{
    protected function getChurchFormComponent(): Component
    {
        return TextInput::make('church')
            ->label('Igreja')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getChurchFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $church = Church::create([
            'name' => $data['church'],
            'slug' => Str::slug($data['church']),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $user = parent::handleRegistration([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'church_id' => $church->id
        ]);

        $church->user_id = $user->id;

        $church->save();

        return $user;
    }
}
