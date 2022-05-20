<x-slot name="header">
    <header>
        <!-- Section Hero -->
        <div class="mx-auto rounded-md flex items-center">
            <div class="flex flex-col text-gray-800 text-center sm:text-left w-full">
                <h1 class="text-4xl font-bold mb-4">
                   {{ \Arr::get($tableAttr, 'tableTitle') }}
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
                         {{ __('Lista') }}
                        </li>
                    </x-tall-breadcrums>
                    <!-- END: breadcrums v1 -->
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
                    @include(include_table("_thed"))
                    <tbody  wire:sortable="updateOrder" class="bg-white divide-y divide-gray-200 ">
                        @forelse ($models as $model)
                            <tr wire:sortable.item="{{ $model->id }}" wire:key="task-{{ $model->id }}">
                                @include(include_table("_checkbox"))
                                @include(include_table("_tbody"))
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
                                <td colspan="{{ $this->count_columns }}">{{ __('Table empty') }}</td>
                            </tr>
                        @endforelse
                        <!-- More people... -->
                    </tbody>
                    <tfoot>
                        @include(include_table("_pagination"))
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
