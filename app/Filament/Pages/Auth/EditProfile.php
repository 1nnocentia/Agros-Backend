<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
// use League\Config\Exception\ValidationException;
use Illuminate\Validation\ValidationException;


class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent()->required(),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $user = $this->getUser();

        if (! Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => "Password yang Anda masukkan tidak sesuai.",
            ]);
        }

        unset($data['current_password']);

        $user->update($data);

        $this->notify('success', 'Profil Anda telah diperbarui.');
    }
}