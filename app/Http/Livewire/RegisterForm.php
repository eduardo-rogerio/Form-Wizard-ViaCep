<?php

namespace App\Http\Livewire;

use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class RegisterForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $data = null;
    public $first_name;
    public $last_name;
    public $company;
    public $phone_number;
    public $website;
    public $unique_visitor;

    public $email;

    public $password;
    public $password_confirmation;
    public $terms;

    public function mount()
    {
        $this->form->fill([
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'company' => fake()->company(),
            'phone_number' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'unique_visitor' => fake()->numberBetween(100, 1000),
            'email' => fake()->email(),
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'terms' => true,
            'postal_code' => '01001-000',
            'number' => fake()->numberBetween(100, 1000),
        ]);
    }

    public function render()
    {
        return view('livewire.register-form');
    }

    public function submit(): void
    {
        sleep(1);
        $this->data = $this->form->getState();
        $this->dispatchBrowserEvent('open-modal', ['id' => 'registerFormSuccess']);
        $this->form->fill();
        $this->dispatchBrowserEvent('form-submitted');
    }

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Step::make('account')
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
                            ->minLength(8)
                            ->confirmed(),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->label('Password Confirmation')
                            ->required(),
                        Checkbox::make('terms')
                            ->columnSpan('full')
                            ->label('I agree to the terms and conditions')
                            ->required(),

                    ])
                    ->columns(2),
                Step::make('address')
                    ->schema([
                        TextInput::make('postal_code')
                            ->mask(fn(Mask $mask) => $mask->pattern('00000-000'))
                            ->minLength(8)
                            ->suffixAction(function ($state, $livewire, $set) {
                                return Action::make('search-action')
                                    ->icon('heroicon-o-search')
                                    ->action(function () use ($livewire, $state, $set) {
                                        $livewire->validateOnly('postal_code');

                                        $requet = Http::get("https://viacep.com.br/ws/{$state}/json/")
                                            ->json();
                                        if (! isset($requet['erro'])) {
                                            $set('street', $requet['logradouro']);
                                            $set('complement', $requet['complemento']);
                                            $set('district', $requet['bairro']);
                                            $set('city', $requet['localidade']);
                                            $set('state', $requet['uf']);
                                        } else {
                                            $set('street', null);
                                            $set('complement', null);
                                            $set('district', null);
                                            $set('city', null);
                                            $set('state', null);

                                            throw ValidationException::withMessages([
                                                'postal_code' => 'Este cep é inválido.',
                                            ]);
                                        }
                                    });
                            })
                            ->label('Postal Code')
                            ->columnSpan(2)
                            ->required(),
                        TextInput::make('street')
                            ->label('Street')
                            ->columnSpan(4)
                            ->required(),
                        TextInput::make('number')
                            ->label('Number')
                            ->columnSpan(2)
                            ->required(),
                        TextInput::make('complement')
                            ->label('Complement')
                            ->columnSpan(4)
                            ->required(),
                        TextInput::make('district')
                            ->label('District')
                            ->columnSpan(3)
                            ->required(),
                        TextInput::make('city')
                            ->label('City')
                            ->columnSpan(3)
                            ->required(),
                        Select::make('state')
                            ->label('State')
                            ->required()
                            ->searchable()
                            ->columnSpanFull()
                            ->options(
                                File::json(public_path('data/states.json'))
                            ),
                    ])
                    ->columns(6),
            ])
                ->startOnStep(1)
                ->submitAction(new HtmlString(view('livewire.register-form-submit')))
                ->extraAttributes([
                    'class' => 'dark:text-white',
                ])
                ->extraAlpineAttributes(['@form-submitted.window' => 'step = \'account\''])
        ];
    }
}
