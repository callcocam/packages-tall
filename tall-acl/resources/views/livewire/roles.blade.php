<form wire:submit.prevent="saveAndStay">
    <x-errors title="We found {errors} validation error(s)" />
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            @if ($field = \Arr::get($fields, 'access'))
                <fieldset>
                    <legend class="text-base font-medium text-gray-900">{{ __("Selecione os papèis")}}</legend>
                    <div class="mt-4 space-y-4">
                        @foreach ($field->options as $option)
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="{{$option->id}}" 
                                    value="{{$option->id}}" 
                                    name="{{$field->name}}" 
                                    type="checkbox"
                                    wire:model.defer="{{$field->key}}.{{$option->id}}"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="{{$option->id}}" class="font-medium text-gray-700">{{ $option->name }}</label>
                                    <p class="text-gray-500">{{ $option->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            @endif
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <x-button type="submit" spinner primary>
                {{ __('Save Or Change') }}
            </x-button>
        </div>
    </div>
</form>
