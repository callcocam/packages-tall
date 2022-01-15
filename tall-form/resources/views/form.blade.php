<x-slot name="header">
    <header>
        <!-- Section Hero -->
        <div class="mx-auto rounded-md flex items-center">
            <div class="flex flex-col text-gray-800 text-center sm:text-left w-full">
                <h1 class="text-4xl font-bold mb-4">
                    {{ \Arr::get($formAttr, 'formTitle') }}
                </h1>
                <section class="flex flex-col w-full">
                    <!-- BEGIN: breadcrums v1 -->
                    <x-tall-breadcrums>
                        <li class="flex justify-items-start text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            {{ \Arr::get($formAttr, 'formAction', __('Form')) }}
                        </li>
                    </x-tall-breadcrums>
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
                                    @include(sprintf('tall-forms::fields.%s',$field->type))
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
                            <x-icon name="plus" class=" w-5 h-5"/>
                            {{ __('Create new') }}
                        </a>
                    @endif
                @endif
                @if ($buttoms)
                    @foreach ($buttoms as $field)
                        @include(sprintf('tall-forms::fields.%s',$field->type))
                    @endforeach
                @endif
            </div>
        </form>
    </div>
</div>
