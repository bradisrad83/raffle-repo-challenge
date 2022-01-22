<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Raffle;

class RaffleDashboard extends Component
{
    public $raffles;
    public $newRaffle = false;
    public $name;
    public $number_of_winners;

    public $rules = [
        'name'              => 'required',
        'number_of_winners' => 'required|integer'
    ];


    public function mount()
    {
        $this->raffles = Raffle::all()->sortDesc();
    }

    public function render()
    {
        return view('livewire.raffle-dashboard');
    }

    public function showForm()
    {
        $this->newRaffle = true;
    }

    public function save()
    {
        $this->validate();
        $raffle = new Raffle();
        $raffle->name = $this->name;
        $raffle->number_of_winners = $this->number_of_winners;
        $raffle->save();
        $this->raffles = Raffle::all()->sortDesc();
        $this->cancel();
    }

    public function cancel()
    {
        $this->name = '';
        $this->number_of_winners = '';
        $this->resetErrorBag('name');
        $this->resetErrorBag('number_of_winners');
        $this->newRaffle = false;
    }
}
