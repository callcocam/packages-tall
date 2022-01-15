<form wire:submit.prevent="saveAndStay">
    <x-errors title="We found {errors} validation error(s)" />
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-4">
                @if ($field = \Arr::get($fields, 'zip'))
                    <div class="col-span-6 sm:col-span-2">
                        <label for="{{ $field->name }}"
                            class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                            wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} rounded-md">
                    </div>
                @endif
                @if ($field = \Arr::get($fields, 'city'))
                    <div class="col-span-6 sm:col-span-3">
                        <label for="{{ $field->name }}"
                            class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                            wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} rounded-md">
                    </div>
                @endif
                @if ($field = \Arr::get($fields, 'state'))
                    <div class="col-span-6 sm:col-span-1">
                        <label for="{{ $field->name }}"
                            class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                        <select id="{{ $field->name }}" name="{{ $field->name }}"
                            wire:model.defer="{{ $field->key }}"
                            class="mt-1 block w-full py-2 px-3 border {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">{{ __('==Select==') }}</option>
                            @foreach (lista_estados() as $sigla => $name)
                                <option value="{{ $sigla }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if ($field = \Arr::get($fields, 'district'))
                    <div class="col-span-6 sm:col-span-3">
                        <label for="{{ $field->name }}"
                            class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                            wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} rounded-md">
                    </div>
                @endif
                @if ($field = \Arr::get($fields, 'number'))
                    <div class="col-span-6 sm:col-span-2">
                        <label for="{{ $field->name }}"
                            class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                            wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                @endif
                
                @if ($field = \Arr::get($fields, 'street'))
                    <div class="col-span-6">
                        <label for="{{ $field->name }}"
                            class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                            wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                @endif
                
                @if ($field = \Arr::get($fields, 'complement'))
                    <div class="col-span-6 sm:col-span-4">
                        <label for="{{ $field->name }}"
                            class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                            wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                @endif
                @if ($field = \Arr::get($fields, 'country'))
                    <div class="col-span-6 sm:col-span-2">
                        <label for="{{ $field->name }}"
                            class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                            wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                @endif
                @if ($field = \Arr::get($fields, 'description_preview'))
                    <div class="col-span-6">
                        <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                            {{ __($field->label) }}
                        </label>
                        <div class="mt-1">
                            <textarea name="{{ $field->name }}" id="{{ $field->name }}"
                                wire:model.defer="{{ $field->key }}" rows="{{ $field->rows }}"
                                cols="{{ $field->cols }}"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                placeholder="{{ $field->placeholder }}"></textarea>
                        </div>
                        @if ($field->hint)
                            <p class="mt-2 text-sm text-gray-500">
                                {{ $field->hint }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <x-button type="submit" spinner primary>
                {{ __('Save Or Change') }}
            </x-button>
        </div>
    </div>
</form>
