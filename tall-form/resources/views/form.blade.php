<x-slot name="header">
    <header>
        <!-- Section Hero -->
        <div class="mx-auto rounded-md flex items-center">
            <div class="flex flex-col text-gray-800 text-center sm:text-left w-full">
                <section class="flex w-full">
                    <h1 class="text-4xl font-bold mb-4">
                        {{ \Arr::get($formAttr, 'formTitle') }}
                    </h1>
                    <!-- BEGIN: breadcrums v1 -->
                    <x-tall-breadcrums>
                        @if (\Route::has(\Str::plural(\Str::beforeLast(\Route::currentRouteName(), '.'))))
                            <li class="flex justify-items-start items-center text-sky-900">
                                <a class="flex items-center"
                                    href="{{ route(\Str::plural(\Str::beforeLast(\Route::currentRouteName(), '.'))) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                    {{ __('Listar') }}
                                </a>
                            </li>
                        @endif
                        <li class="flex justify-items-start items-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                            {{ \Arr::get($formAttr, 'formAction', __('Form')) }}
                        </li>
                    </x-tall-breadcrums>
                    @if ($preview = \Arr::get($formAttr, 'preview', false))
                        @if (\Route::has($preview))
                            <x-button href="{{ route($preview, $model) }}" target="_blank"
                                label="{{ __('Visualizar') }}" teal />
                        @endif
                    @endif
                    <!-- END: breadcrums v1 -->
                </section>
            </div>
        </div>
    </header>
</x-slot>
<div class="flex flex-col">
    <div class="mt-5 md:mt-0">
        <form wire:submit.prevent="saveAndStay">
            <x-errors title="We found {errors} validation error(s)" />
            <div class="shadow sm:rounded-md ">
                <div class="px-4 py-5 bg-white space-y-6">
                    <div class="md:grid md:grid-cols-12 gap-y-3 gap-x-4">
                        @if ($fields)
                            @foreach ($fields as $field)
                                <div class="col-span-{{ $field->span }} ">
                                    @include(sprintf('tall-forms::fields.%s', $field->type))
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 z-10 space-x-2">
                @if ($url = $this->goBack())
                    <a class="focus:outline-none px-2.5 py-1.5 flex justify-center gap-x-2 items-center
                    transition-all ease-in duration-75 focus:ring-2 focus:ring-offset-2
                    hover:shadow-sm disabled:opacity-60 disabled:cursor-not-allowed rounded-md text-sm ring-red-600 text-white bg-red-500 hover:bg-red-600
                            dark:ring-offset-secondary-800 dark:bg-primary-700 dark:ring-primary-700"
                        href="{{ $url }}">
                        {{ __('Back to list') }}</a>
                @endif
                @if ($url = $this->create)
                    @if (\Route::has($url))
                        <a class="focus:outline-none px-2.5 py-1.5 flex justify-center gap-x-2 items-center
          transition-all ease-in duration-75 focus:ring-2 focus:ring-offset-2
          hover:shadow-sm disabled:opacity-60 disabled:cursor-not-allowed rounded-md text-sm ring-green-600 text-white bg-green-500 hover:bg-green-600
                  dark:ring-offset-secondary-800 dark:bg-primary-700 dark:ring-primary-700"
                            href="{{ route($url) }}">
                            <x-icon name="plus" class=" w-5 h-5" />
                            {{ __('Create new') }}
                        </a>
                    @endif
                @endif
                @if ($buttoms)
                    @foreach ($buttoms as $field)
                        @include(sprintf('tall-forms::fields.%s', $field->type))
                    @endforeach
                @endif
            </div>
        </form>
    </div>
</div>
