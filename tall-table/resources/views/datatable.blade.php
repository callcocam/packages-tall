<x-slot name="header">
    <header>
        <!-- Section Hero -->
        <div class="mx-auto rounded-md flex items-center">
            <div class="flex flex-col text-gray-800 text-center sm:text-left w-full">
                <section class="flex  w-full">
                    <!-- BEGIN: breadcrums v1 -->
                    <h1 class="text-4xl font-bold mb-4">
                        {{ \Arr::get($tableAttr, 'tableTitle') }}
                    </h1>
                    <x-tall-breadcrums>
                        <li class="flex justify-items-start items-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                            {{ __('Listar') }}
                        </li>
                    </x-tall-breadcrums>
                    <!-- END: breadcrums v1 -->
                    <div class="mr-10 flex-1 items-end">
                        @if ($reports->count())
                            @livewire('tall-table::reports-component', ['models' => $reports], key(uniqId($reports->count())))
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </header>
</x-slot>
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto">
        <div class="py-2 min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg min-h-[400px]">
                @include(include_table('filters._show-filters'))
                <table class="min-w-full divide-y divide-gray-200">
                    @include(include_table('_thed'))
                    <tbody @if ($sortable) wire:sortable="updateOrder" @endif
                        class="bg-white divide-y divide-gray-200 ">
                        @forelse ($models as $model)
                            <tr
                                @if ($sortable) wire:sortable.item="{{ $model->id }}" 
                             wire:key="task-{{ $model->id }}" @endif>
                                @include(include_table('_checkbox'))

                                @include(include_table('_tbody'))
                                @if ($actions)
                                    <td>
                                        <div class="flex px-2 space-x-2 align-middle">
                                            @foreach ($actions as $action)
                                                @include(include_table($action->view), compact('model'))
                                            @endforeach
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $this->count_columns }}">{{ __('Nenhum registro encontrado') }}</td>
                            </tr>
                        @endforelse
                        <!-- More people... -->
                    </tbody>
                    <tfoot>
                        @include(include_table('_pagination'))
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
