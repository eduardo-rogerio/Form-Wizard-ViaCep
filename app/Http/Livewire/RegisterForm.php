<?php

namespace App\Http\Livewire;

use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
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
        $data = $this->validate();
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('email')
                        ->email()
                        ->columnSpan('full')
                        ->label('Email')
                        ->required(),
                    TextInput::make('first_name')
                        ->rule('min:3')
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
                        ->url()
                        ->label('Website')
                        ->required(),
                    TextInput::make('unique_visitor')
                        ->numeric()
                        ->label('Unique Visitor')
                        ->required(),
                    TextInput::make('password')
                        ->password()
                        ->label('Password')
                        ->required()
                        ->minLength(8),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->label('Password Confirmation')
                        ->required(),
                    Checkbox::make('terms')
                        ->columnSpan('full')
                        ->label('I agree to the terms and conditions')
                        ->required(),
                ]),

        ];
    }
}
