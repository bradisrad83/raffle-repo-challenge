<div class="my-4 w-full rounded-lg shadow-lg p-4" x-data="{show: false}">
    <div class="flex items-center justify-between cursor-pointer" @click="show = !show">
        <h2 class="text-2xl {{$raffle->isComplete() ? 'line-through' : ''}}" >{{ $raffle->name }} - <span class="text-xl"> {{ $raffle->number_of_winners}} winners<span></h2>
        <i x-show="show" class="fas fa-chevron-up"></i>
        <i x-show="!show" class="fas fa-chevron-down"></i>
    </div>
    <div x-show="show" class="max-h-96 overflow-scroll">
        @if(!$raffle->isComplete())
            <div class="flex justify-between">
                <button wire:click="showEntry()" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded mt-2">New Entry</button>
                @if($raffle->number_of_winners <= $raffle->users->count())
                    <button wire:click="selectWinner()" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded mt-2">Select {{$raffle->number_of_winners - $raffle->winners->count()}} Winner(s)</button>
                @else
                    <span class="font-bold">Please enter at least {{ $raffle->number_of_winners }} entries before selecting winner(s).</span>
                @endif
            </div>
        @endif
        @if($newEntry) 
            <div class="flex flex-col md:flex-row items-start">
                <div class="w-full md:w-1/2 mr-4 my-1">
                    @include('partials._text-field-input', ['model' => 'name', 'label' => 'Name of Entry'])
                </div>
                <div class="w-full md:w-1/2 my-1">
                    @include('partials._text-field-input', ['model' => 'phone_number', 'label' => 'Phone Number of Entry'])
                </div>
            </div>
            <div class="flex">
                <button wire:click="saveEntry()" class="mx-1 bg-green-700 px-4 py-2 rounded text-white hover:bg-green-800 my-4">
                    <span>Save</span>
                </button>
                <button wire:click="cancel()" class="mx-1 bg-red-700 px-4 py-2 rounded text-white hover:bg-red-800 my-4">
                    <span>Cancel</span>
                </button>
        </div>        
        @endif
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
        @foreach($raffle->users->sortDesc() as $user) 
            <div class="my-1 {{ $raffle->winners->contains($user) ? 'text-green-600 font-bold' : ''}}">
                <p>{{$user->name}}</p>
                <p>{{$user->phone_number}}<p>
            </div>
        @endforeach
        </div>
    </div>
</div>
