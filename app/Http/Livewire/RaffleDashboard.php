<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Raffle;
use App\Models\User;

class RaffleDashboard extends Component
{
    public $raffles;
    public $newRaffle = false;
    public $newEntry = false;
    public $raffle_name;
    public $number_of_winners;
    public $entry_name;
    public $phone_number;
    public $raffle = null;

    public function mount()
    {
        $this->raffles = Raffle::all()->sortDesc();
    }

    public function render()
    {
        return view('livewire.raffle-dashboard');
    }

    public function showForm($value)
    {
        if ($value == 'raffle') {
            $this->newRaffle = true;
            $this->cancelEntry();
        } else {
            $this->newEntry = true;
            $this->cancelRaffle();
        }
    }

    public function saveRaffle()
    {
        $this->validate([
            'raffle_name'       => 'required',
            'number_of_winners' => 'required|integer'
        ]);
        $raffle = new Raffle();
        $raffle->name = $this->raffle_name;
        $raffle->number_of_winners = $this->number_of_winners;
        $raffle->save();
        $this->raffles = Raffle::all()->sortDesc();
        $this->cancelRaffle();
    }

    public function cancelRaffle()
    {
        $this->raffle_name = '';
        $this->number_of_winners = '';
        $this->resetErrorBag('raffle_name');
        $this->resetErrorBag('number_of_winners');
        $this->newRaffle = false;
    }

    public function saveEntry()
    {
        $this->validate([
            'entry_name'    => 'required',
            'phone_number'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'raffle'        => 'required',
        ]);
        $user = new User();
        $user->name = $this->entry_name;
        $user->phone_number = $this->phone_number;
        $user->save();
        $raffle = Raffle::find($this->raffle);
        $raffle->users()->attach($user);
        $this->emitTo('raffle-component', 'refreshComponent');
    }

    public function cancelEntry()
    {
        $this->entry_name = '';
        $this->phone_number = '';
        $this->raffle = null;
        $this->resetErrorBag('entry_name');
        $this->resetErrorBag('phone_number');
        $this->resetErrorBag('raffle');
        $this->newEntry = false;
    }

    public function openRaffles()
    {
        return $this->raffles->filter(function ($raffle) {
            return !$raffle->isComplete();
        });
    }
}
