<div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Perfil') }}</h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Essas informações serão exibidas publicamente, portanto, tome cuidado com o que você compartilha.') }}
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <x-errors title="We found {errors} validation error(s)" />
            <form wire:submit.prevent="saveAndStay">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <div class="grid grid-cols-4 gap-4">
                            @if ($field = \Arr::get($fields, 'name'))
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                                            wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                            @if ($field = \Arr::get($fields, 'email'))
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                                            wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-4 gap-4">
                            @if ($field = \Arr::get($fields, 'phone'))
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                                            wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                            @if ($field = \Arr::get($fields, 'birth_date'))
                                <div class="col-span-4 sm:col-span-2">
                                    @include(sprintf('tall-forms::fields.%s', $field->type))
                                </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-4 gap-4">
                            @if ($field = \Arr::get($fields, 'cpf'))
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                                            wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                            @if ($field = \Arr::get($fields, 'rg'))
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                                            wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-6 gap-4">
                            @if ($field = \Arr::get($fields, 'instituicao_id'))
                                <div class="col-span-6 sm:col-span-6">
                                    @include(sprintf('tall-forms::fields.%s', $field->type))
                                </div>
                            @endif
                            @if ($field = \Arr::get($fields, 'office_id'))
                                <div class="col-span-4 sm:col-span-3">
                                    @include(sprintf('tall-forms::fields.%s', $field->type))
                                </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-6 gap-4">
                            @if ($field = \Arr::get($fields, 'current_password'))
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="password" name="{{ $field->name }}" id="{{ $field->name }}"
                                            wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                            @if ($field = \Arr::get($fields, 'password'))
                                <div class="col-span-4 sm:col-span-4">
                                    <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0  {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="password" name="{{ $field->name }}"
                                            id="{{ $field->name }}" wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                            @if ($field = \Arr::get($fields, 'new_password'))
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="{{ $field->name }}"
                                        class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0  {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="password" name="{{ $field->name }}"
                                            id="{{ $field->name }}" wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                            @if ($field = \Arr::get($fields, 'password_confirmation'))
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="{{ $field->name }}"
                                        class="block text-sm font-medium text-gray-700">
                                        {{ __($field->label) }}
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }} bg-gray-50 text-gray-500 text-sm">
                                            <x-icon name="{{ $field->icon }}" class="h-4 w-4" />
                                        </span>
                                        <input type="password" name="{{ $field->name }}"
                                            id="{{ $field->name }}" wire:model.defer="{{ $field->key }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm {{ $errors->has($field->name) ? 'border-red-300' : 'border-gray-300' }}"
                                            placeholder="{{ $field->placeholder }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($field = \Arr::get($fields, 'profile_photo_path'))
                            <div x-data={}>
                                <label class="block text-sm font-medium text-gray-700">
                                    {{ __($field->label) }}
                                </label>
                                <div class="mt-1 flex items-center">
                                    <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                        @if (isset($data[$field->name]) && $data[$field->name] instanceof \Livewire\TemporaryUploadedFile)
                                            <img src="{{ $data[$field->name]->temporaryUrl() }}" alt="">
                                        @else
                                            @if ($profile_photo_url = \Arr::get($model, 'profile_photo_url'))
                                                <img src="{{ $profile_photo_url }}" alt="{{ $model->name }}">
                                            @else
                                                <svg class="h-full w-full text-gray-300" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            @endif
                                        @endif
                                    </span>
                                    <input hidden x-ref="{{ $field->name }}" type="file"
                                        name="{{ $field->name }}" id="{{ $field->name }}"
                                        wire:model.lazy="{{ $field->key }}">
                                    <label for="{{ $field->name }}"
                                        class="ml-5 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Change Photo') }}
                                    </label>

                                </div>
                            </div>
                        @endif
                        @if ($field = \Arr::get($fields, 'description_preview'))
                            <div>
                                <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700">
                                    {{ __($field->label) }}
                                </label>
                                <div class="mt-1">
                                    <textarea name="{{ $field->name }}" id="{{ $field->name }}" wire:model.defer="{{ $field->key }}"
                                        rows="{{ $field->rows }}" cols="{{ $field->cols }}"
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
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-button type="submit" spinner primary>
                            {{ __('Save Or Change') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if ($basic)
        @if (method_exists($model, 'address'))
            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                {{ __('Cadastrar ou atualizar endreços') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Informe o endreço do usuário selecionado') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        @livewire('tall-acl::admin.operacional.users.address-component', ['model' => $model], key($model->id))
                    </div>
                </div>
            </div>
        @endif

        @if (method_exists($model, 'roles'))
            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                {{ __('Controle de acesso ao sistema') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Definir papeis para o usuário selecionado') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        @livewire('tall-acl::admin.operacional.users.roles-component', ['model' => $model], key(sprintf('roles-%s', $model->id)))
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
