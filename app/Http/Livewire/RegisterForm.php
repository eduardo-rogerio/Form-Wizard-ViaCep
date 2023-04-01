<?php

namespace App\Http\Livewire;

use Filament\Forms;
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
            Forms\Components\TextInput::make('first_name')
                ->label('First Name')
                ->required(),
        ];
    }
}
