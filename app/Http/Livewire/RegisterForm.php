<?php

namespace App\Http\Livewire;

use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Livewire\Component;

class RegisterForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public function render()
    {
        return view('livewire.register-form');
    }

    public function submit(): void
    {

    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('first_name')
                ->label('First Name')
                ->required(),
            TextInput::make('last_name')
                ->label('Last Name')
                ->required(),
            TextInput::make('company')
                ->label('Company')
                ->required(),
            TextInput::make('phone_number')
                ->label('Phone Number')
                ->required(),
            TextInput::make('website')
                ->label('Website')
                ->required(),
            TextInput::make('unique_visitor')
                ->label('Unique Visitor')
                ->required(),
            TextInput::make('email')
                ->label('Email')
                ->required(),
            TextInput::make('password')
                ->label('Password')
                ->required(),
            TextInput::make('password_confirmation')
                ->label('Password Confirmation')
                ->required(),
            Checkbox::make('terms')
                ->label('Terms')
                ->required(),
        ];
    }
}
