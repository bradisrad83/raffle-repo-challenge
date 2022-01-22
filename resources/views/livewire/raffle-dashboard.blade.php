<div class="px-4">
    <div class="my-4">
        @if(!$newRaffle)
            <button wire:click="showForm()" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">New Raffle</button>
        @endif
        @if($newRaffle) 
            <div class="flex flex-col md:flex-row items-start">
                <div class="w-1/2 mr-4 my-1">
                    @include('partials._text-field-input', ['model' => 'name', 'label' => 'Name of Raffle'])
                </div>
                <div class="w-1/6 my-1">
                    @include('partials._text-field-input', ['model' => 'number_of_winners', 'label' => 'Number of Winners'])
                </div>
            </div>
            <div class="flex">
                <button wire:click="save()" class="mx-1 bg-green-700 px-4 py-2 rounded text-white hover:bg-green-800 my-4">
                    <span>Save</span>
                </button>
                <button wire:click="cancel()" class="mx-1 bg-red-700 px-4 py-2 rounded text-white hover:bg-red-800 my-4">
                    <span>Cancel</span>
                </button>
            </div>
        @endif 
    </div>
    @foreach($raffles as $raffle)
        <livewire:raffle-component :raffle="$raffle" :key="$raffle->id"/>
    @endforeach
</div>
