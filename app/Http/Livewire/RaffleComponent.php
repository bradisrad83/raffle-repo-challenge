<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Raffle;
use App\Models\User;

class RaffleComponent extends Component
{
    public $raffle;
    public $newEntry = false;
    public $name;
    public $phone_number;

    public $rules = [
        'name'          => 'required',
        'phone_number'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
    ];

    public function mount(Raffle $raffle)
    {
        $this->raffle = $raffle;
    }

    public function render()
    {
        return view('livewire.raffle-component');
    }

    public function showEntry()
    {
        $this->newEntry = true;
    }

    public function cancel()
    {
        $this->name = '';
        $this->phone_number = '';
        $this->resetErrorBag('name');
        $this->resetErrorBag('number_of_winners');
        $this->newEntry = false;
    }

    public function saveEntry()
    {
        $this->validate();
        $user = new User();
        $user->name = $this->name;
        $user->phone_number = $this->phone_number;
        $user->save();
        $this->name = '';
        $this->phone_number = '';
        $this->raffle->users()->attach($user);
        $this->raffle = $this->raffle->fresh();
    }

    public function selectWinner()
    {
        $this->cancel();
        $winner = $this->raffle->users->random(1);
        if ($this->raffle->winners->contains($winner[0]->id)) {
            $this->selectWinner();
        }
        $this->raffle->winners()->attach($winner);
        $this->raffle = $this->raffle->fresh();
    }
}
