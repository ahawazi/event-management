<?php

namespace App\Livewire;

use App\Models\Attendee;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Livewire\Component;

class ConferenceSignUpPage extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public int $conferenceId;
    public int $price = 50000;

    public function mount()
    {
        // TODO
        $this->conferenceId = 1;
    }


    public function signUpAction(): Action
    {
        return Action::make('SignUp')
            ->slideOver()
            ->form([
                Repeater::make('attendees')
                    ->schema(Attendee::getForm()),
            ])

            ->action(function (array $data) {
                collect($data['attendees'])->each(function ($data) {
                    Attendee::create([
                        'conference_id' => $this->conferenceId,
                        'ticket_cost' => $this->price,
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'is_paid' => true,
                    ]);
                });
            });
    }

    public function render()
    {
        return view('livewire.conference-sign-up-page');
    }
}
