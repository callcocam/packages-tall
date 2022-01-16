<header class="flex w-full h-16 relative z-50 bg-white ">
    <div
        class="w-full md:w-60 z-30 flex bg-gray-800 justify-start px-4 items-center border-b-1 border-r-1 border-gray-300 fixed  h-16 shadow-lg">
        <img class="flex w-48"
            src="{{ asset('img/webpaes.png') }}" alt="Logo" />

    </div>
    <div class="hidden ml-60 w-full md:flex justify-between border-l-2 shadow-lg ">
        <div class="flex h-full flex-1">
            <ul class="flex items-center h-full w-full lg:w-7/12 justify-between">
                <li class="h-full w-full flex items-center"><a
                        class="h-full flex items-center border-t-4 transition-all ease-in-out duration-500 font-bold border-t-white hover:border-indigo-500 w-full justify-center"
                        href="">Home</a></li>
            </ul>
        </div>
        <div class="flex">
            <ul class="flex space-x-6 px-6 items-center w-full justify-between">
                <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg></a></li>

                <li class="relative flex">
                    <div x-data="{showDropdown: false}" @click.away="showDropdown = false">
                        <a href=""
                            class=" py-2 px-2 flex w-full items-center justify-between rounded hover:shadow hover:text-gray-200 transition-colors ease-in-out duration-500"
                            @click.prevent="showDropdown = ! showDropdown">
                            <div class="flex items-center">
                                <img class="flex w-12 h-12 rounded-full"
                                    src="http://demo.lion-coders.com/html/sarchholm-real-estate-template/images/dashboard/agent_db_1.jpg"
                                    alt="User" />
                            </div>
                        </a>
                        <div class="overflow-hidden max-h-0 transition-all ease-in-out duration-200 absolute right-0 border-b-2 bg-white z-40"
                            x-ref="dropdownContainer"
                            x-bind:style="showDropdown ? 'max-height: ' + $refs.dropdownContainer.scrollHeight + 'px' : ''">
                            <a href=""
                                class="my-2 py-2 px-2 flex items-center rounded hover:bg-gray-800 hover:shadow hover:text-gray-200 transition-colors ease-in-out duration-500">
                                <span class="mr-4">
                                    <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M20.71 16.71l-2.42-2.42a1 1 0 00-1.42 0l-3.58 3.58a1 1 0 00-.29.71V21a1 1 0 001 1h2.42a1 1 0 00.71-.29l3.58-3.58a1 1 0 000-1.42zM16 20h-1v-1l2.58-2.58 1 1zm-6 0H6a1 1 0 01-1-1V5a1 1 0 011-1h5v3a3 3 0 003 3h3v1a1 1 0 002 0V9v-.06a1.31 1.31 0 00-.06-.27v-.09a1.07 1.07 0 00-.19-.28l-6-6a1.07 1.07 0 00-.28-.19.32.32 0 00-.09 0L12.06 2H6a3 3 0 00-3 3v14a3 3 0 003 3h4a1 1 0 000-2zm3-14.59L15.59 8H14a1 1 0 01-1-1zM8 14h6a1 1 0 000-2H8a1 1 0 000 2zm0-4h1a1 1 0 000-2H8a1 1 0 000 2zm2 6H8a1 1 0 000 2h2a1 1 0 000-2z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="flex">Roles</span>
                            </a>
                            <a href=""
                                class="my-2 py-2 px-2 flex items-center rounded hover:bg-gray-800 hover:shadow hover:text-gray-200 transition-colors ease-in-out duration-500">
                                <span class="mr-4">
                                    <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M10.21 14.75a1 1 0 001.42 0l4.08-4.08a1 1 0 00-1.42-1.42l-3.37 3.38-1.21-1.22a1 1 0 00-1.42 1.42zM21 2H3a1 1 0 00-1 1v18a1 1 0 001 1h18a1 1 0 001-1V3a1 1 0 00-1-1zm-1 18H4V4h16z" />
                                    </svg>
                                </span>
                                <span class="flex">Permissions</span>
                            </a>
                            <a href=""
                                class="my-2 py-2 px-2 flex items-center rounded hover:bg-gray-800 hover:shadow hover:text-gray-200 transition-colors ease-in-out duration-500">
                                <span class="mr-4">
                                    <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12.3 12.22A4.92 4.92 0 0014 8.5a5 5 0 00-10 0 4.92 4.92 0 001.7 3.72A8 8 0 001 19.5a1 1 0 002 0 6 6 0 0112 0 1 1 0 002 0 8 8 0 00-4.7-7.28zM9 11.5a3 3 0 113-3 3 3 0 01-3 3zm9.74.32A5 5 0 0015 3.5a1 1 0 000 2 3 3 0 013 3 3 3 0 01-1.5 2.59 1 1 0 00-.5.84 1 1 0 00.45.86l.39.26.13.07a7 7 0 014 6.38 1 1 0 002 0 9 9 0 00-4.23-7.68z" />
                                    </svg>
                                </span>
                                <span class="flex">Users</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
