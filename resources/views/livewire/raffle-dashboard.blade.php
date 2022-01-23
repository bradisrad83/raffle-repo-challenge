<div class="px-4">
    <div class="my-4">
        <div>
            @if(!$newRaffle)
                <button wire:click="showForm('raffle')" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">New Raffle</button>
            @endif
            @if($newRaffle) 
                <div class="flex flex-col md:flex-row items-start">
                    <div class="w-1/2 mr-4 my-1">
                        @include('partials._text-field-input', ['model' => 'raffle_name', 'label' => 'Name of Raffle'])
                    </div>
                    <div class="w-1/6 my-1">
                        @include('partials._text-field-input', ['model' => 'number_of_winners', 'label' => 'Number of Winners'])
                    </div>
                </div>
                <div class="flex">
                    <button wire:click="saveRaffle()" class="mx-1 bg-green-700 px-4 py-2 rounded text-white hover:bg-green-800 my-4">
                        <span>Save</span>
                    </button>
                    <button wire:click="cancelRaffle()" class="mx-1 bg-red-700 px-4 py-2 rounded text-white hover:bg-red-800 my-4">
                        <span>Cancel</span>
                    </button>
                </div>
            @endif 
        </div>
        @if(!$newEntry)
            <button wire:click="showForm('entry')" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded my-2">New Entry</button>
        @endif
        @if($newEntry) 
        <div class="flex flex-col md:flex-row flex-wrap items-start">
            <div class="w-full md:w-1/3 mr-4 my-1">
                @include('partials._text-field-input', ['model' => 'entry_name', 'label' => 'Name of Entry'])
            </div>
            <div class="w-full md:w-1/3 my-1">
                @include('partials._text-field-input', ['model' => 'phone_number', 'label' => 'Phone Number of Entry'])
            </div>
            <div class="w-full md:w-1/3">
                <select wire:model="raffle" class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-light-blue-500 focus:border-light-blue-500 sm:text-sm">
                    <option value="null">Select A Raffle To Enter</option>
                    @foreach($this->openRaffles() as $raffle)
                        <option value="{{$raffle->id}}">{{ $raffle->name }}</option>
                    @endforeach
                </select>
                @error('raffle')<p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="flex">
            <button wire:click="saveEntry()" class="mx-1 bg-green-700 px-4 py-2 rounded text-white hover:bg-green-800 my-4">
                <span>Save</span>
            </button>
            <button wire:click="cancelEntry()" class="mx-1 bg-red-700 px-4 py-2 rounded text-white hover:bg-red-800 my-4">
                <span>Cancel</span>
            </button>
        </div>
    @endif         
    </div>
    @foreach($raffles as $raffle)
        <livewire:raffle-component :raffle="$raffle" :key="$raffle->id"/>
    @endforeach
</div>
