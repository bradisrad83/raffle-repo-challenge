<label class="block text-gray-700 text-xs uppercase font-bold mb-2" for="{{ str_replace('.', '_', $model) }}">
    {{ $label }}
</label>
<input wire:model.debounce.500ms="{{ $model }}"
    id="{{ str_replace('.', '_', $model) }}" type="@if(isset($type)){!! $type !!}@else{!! "text" !!}@endif" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-fa-blue-500 focus:ring-fa-blue-500 sm:text-sm" placeholder="{{ $placeholder ?? '' }}">
    @error($model) <p class="text-red-600 text-sm">{{ str_replace('.', ' ', $message) }}</p> @enderror
