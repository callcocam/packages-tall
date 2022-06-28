<div x-data="nav" class="border-r-2">
    <button x-on:click="toggle()" class="p-2 absolute right-4 top-5 flex md:hidden z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            <path x-show="show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <div x-show="show" class="absolute w-full  left-60 bg-black/30 transition-all ease-in-out duration-500"
        x-on:click="toggle()"></div>
    <div class="w-60 transition-all ease-in-out duration-500 absolute " x-ref="boxElement">
        <div class="relative w-full">
            <nav x-ref="navElement"
                class="md:ml-0 pb-8 w-60 bg-slate-100 h-screen flex z-10 fixed  overflow-y-auto scrollbar-thin scrollbar-thumb-indigo-300 scrollbar-track-gray-100 top-16">
                <ul class="w-full">
                    @if (\Route::has('admin'))
                        @can('dashboard')
                            <x-tall-nav-link icon="home" href="{{ route('admin') }}" :active="request()->routeIs('admin')">
                                {{ __('PAINEL') }}
                            </x-tall-nav-link>
                        @endcan
                    @endif
                    @if (\Route::has(config('tenant.routes.tenants.show')))
                        @can(config('tenant.routes.tenants.show'))
                            <x-tall-nav-link icon="adjustments"
                                href="{{ route(config('tenant.routes.tenants.show'), app('currentTenant')) }}">
                                {{ __('TENANT') }}
                            </x-tall-nav-link>
                        @endcan
                    @endif
                    @if ($menus)
                        @foreach ($menus as $menu)
                            @if ($submenus = \Arr::get($menu, 'submenus'))
                                @canany(\Arr::get($menu, 'active', []))
                                    <x-tall-dropdown-link icon="{{ \Arr::get($menu, 'icon', 'plus') }}"
                                        label="{{ __(\Arr::get($menu, 'label')) }}" :active="request()->routeIs(\Arr::get($menu, 'active', []))">
                                        @foreach ($submenus as $submenu)
                                            @if (\Route::has(\Arr::get($submenu, 'route')))
                                                @can(\Arr::get($submenu, 'route'))
                                                    <x-tall-nav-link-dropdown
                                                        href="{{ route(\Arr::get($submenu, 'route'), \Arr::get($submenu, 'params', [])) }}"
                                                        :active="request()->routeIs(\Arr::get($submenu, 'route'))">
                                                        {{ __(\Arr::get($submenu, 'label')) }}
                                                    </x-tall-nav-link-dropdown>
                                                @endcan
                                            @endif
                                        @endforeach
                                    </x-tall-dropdown-link>
                                @endcanany
                            @else
                                @if (\Route::has(\Arr::get($menu, 'route')))
                                    @can(\Arr::get($menu, 'route'))
                                        <x-tall-nav-link icon="{{ \Arr::get($menu, 'icon', 'plus') }}"
                                            href="{{ route(\Arr::get($menu, 'route'), \Arr::get($menu, 'params', [])) }}"
                                            :active="request()->routeIs(\Arr::get($menu, 'route'))">
                                            {{ __(\Arr::get($menu, 'label')) }}
                                        </x-tall-nav-link>
                                    @endcan
                                @endif
                            @endif
                        @endforeach
                    @endif
                    @if (\Route::has('home'))
                        <x-tall-nav-link icon="home" href="{{ route('home') }}" target="_blank">
                            {{ __('IR PARA O SITE') }}
                        </x-tall-nav-link>
                    @endif
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-tall-nav-link icon="logout" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                               this.closest('form').submit();">
                            {{ __('SAIR') }}
                        </x-tall-nav-link>
                    </form>
                    <li class="w-full h-20">

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nav', () => ({
                open: false,
                show: false,
                init() {
                    window.addEventListener('resize', (e) => {
                        this.resize(e.target.innerWidth);
                    })
                    this.resize(window.innerWidth);
                },
                resize(innerWidth) {
                    if (innerWidth > 763) {
                        if (this.$refs.boxElement.classList.contains('absolute')) {
                            this.$refs.boxElement.classList.remove('absolute')
                            this.$refs.boxElement.classList.remove('-ml-64')
                            this.show = false
                        }
                    } else {
                        this.$refs.boxElement.classList.add('-ml-64')
                        this.$refs.boxElement.classList.add('absolute')
                        this.open = true;
                    }
                },
                toggle() {
                    this.show = !this.show
                    this.$refs.boxElement.classList.toggle('-ml-64')
                    if (!this.open) {
                        if (this.$refs.boxElement.classList.contains('absolute')) {
                            setTimeout(() => {
                                this.open = false;
                                this.$refs.boxElement.classList.remove('absolute')
                            }, 600);
                        } else {
                            this.$refs.boxElement.classList.add('absolute')
                            this.open = true;
                        }
                    }
                },
            }))
        })
    </script>
@endpush
