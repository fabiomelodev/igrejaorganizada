<?php

namespace App\Filament\Auth\Pages;

use App\Models\Position;
use App\Models\Team;
use App\Models\TeamUser;
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
        return TextInput::make('team')
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
        $team = Team::create([
            'name' => $data['team'],
            'slug' => Str::slug($data['team']),
            'is_active' => 1,
            'plan_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $user = parent::handleRegistration([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => 1,
            'team_id' => $team->id
        ]);

        if (!$user->hasRole('Administrador')) {
            $user->assignRole('Administrador');
        }

        $team->save();

        $userSuperAdmin = User::role('super_admin')->first();

        TeamUser::create([
            'team_id' => $team->id,
            'user_id' => $user->id
        ]);

        TeamUser::create([
            'team_id' => $team->id,
            'user_id' => $userSuperAdmin->id
        ]);

        Position::firstOrCreate(
            [
                'name' => 'Visitante',
                'team_id' => $team->id
            ],
            ['status' => 1]
        );


        return $user;
    }
}
