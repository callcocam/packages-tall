<div class="flex flex-col">
    <div>
        <div x-data="{
            open: false,
            menu: false,
            toggleMenu() {
                this.menu = !this.menu
            },
            toggle() {
                this.open = !this.open
            }
        }" class="bg-white">

            <div class="overflow-hidden">
                {{-- @include('tall-report::partials.mobile') --}}
                <main class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="relative z-10 flex items-baseline justify-between pt-2 pb-6 border-b border-gray-200">
                        <header class="w-full">
                            <!-- Section Hero -->
                            <div class="mx-auto rounded-md flex items-center">
                                <div class="flex flex-col text-gray-800 text-center sm:text-left w-full">
                                    <section class="flex w-full">
                                        <h1 class="text-4xl font-bold mb-4 w-1/3">
                                            {{ \Arr::get($formAttr, 'formTitle') }}
                                        </h1>
                                        <!-- BEGIN: breadcrums v1 -->
                                        <x-tall-breadcrums>
                                            @if (\Route::has(\Str::plural(\Str::beforeLast(\Route::currentRouteName(), '.'))))
                                                <li class="flex justify-items-start items-center text-sky-900">
                                                    <a class="flex items-center"
                                                        href="{{ route(\Str::plural(\Str::beforeLast(\Route::currentRouteName(), '.'))) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 5l7 7-7 7" />
                                                        </svg>
                                                        {{ __('Listar') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="flex justify-items-start items-center text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                                {{ __('Relatório') }}
                                            </li>
                                        </x-tall-breadcrums>
                                        <!-- END: breadcrums v1 -->
                                    </section>
                                </div>
                            </div>
                        </header>
                    </div>
                    <section aria-labelledby="products-heading" class="pt-1 pb-24">
                        <div class="grid grid-cols-1  gap-x-8 gap-y-10 relative">
                            <!-- Filters -->
                            {{-- @include('tall-report::partials.desktop') --}}
                            <!-- Product grid -->
                            <div class="col-span-1">
                                <!-- Replace with your content -->
                                <div
                                    class="block border-4 border-dashed border-gray-200  p-2 rounded-lg h-96  lg:h-full z-20">
                                    @include('tall-report::partials.header')
                                    @if ($selecteds = array_filter($checkboxValues))
                                        @if ($models= $this->models)
                                            <div class="flex flex-col">
                                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                                        <div class="overflow-hidden">
                                                            @if (array_filter($selecteds))
                                                                <table class="w-full text-left lg:h-[500px]">
                                                                    @include('tall-report::partials.table.thead')
                                                                    <tbody class="h-96 w-full overflow-y-scroll">
                                                                        @foreach ($models as $model)
                                                                            <tr class="bg-white border-b w-full">
                                                                                @foreach ($selecteds as $name => $items)
                                                                                    @if (is_string($items))
                                                                                        <td
                                                                                            class="px-6 py-2 text-sm font-medium text-gray-900">
                                                                                            {{ data_get($model, $items) }}
                                                                                        </td>
                                                                                    @else
                                                                                        @if ($selecteds_items = array_filter($items))
                                                                                            @foreach ($selecteds_items as $item)
                                                                                                <td
                                                                                                    class="px-6 py-2 text-sm font-medium text-gray-900">
                                                                                                    {{ data_get($model, sprintf('%s.%s', $name, $item)) }}
                                                                                                </td>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach

                                                                            </tr>
                                                                        @endforeach
                                                                </table>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <!-- /End replace -->
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
        @push('scripts')
            <script>
                window.addEventListener("load", function(event) {
                    console.log("Todos os recursos terminaram o carregamento!");
                });
            </script>
        @endpush
    </div>
</div>
