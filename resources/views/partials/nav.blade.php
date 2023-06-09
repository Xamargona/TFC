<nav class="border-gray-200 dark:bg-gray-900 fixed w-full top-0 z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        {{-- LOGO --}}
        <a href="{{ route('inicio') }}" class="flex items-center">
            <img src="/app/logo2.png" class="h-14 mr-3" alt="Logo" />
            <span class="self-center text-3xl font-semibold whitespace-nowrap  text-red-800 font-serif italic">Kuro Ink</span>
        </a>

        @if (Auth::check())
            <div class="flex items-center md:order-2">
                <button type="button"
                    class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 "
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    {{-- FOTO DE PERFIL --}}
                    @if (Auth::user()->avatar)
                        <img class="w-11 h-11 rounded-full" src="/images/{{(Auth::user()->avatar)}}"
                            alt="profile picture">
                    @else
                        <img class="w-11 h-11 rounded-full" src="/app/placeholder.jpg"
                            alt="profile picture">
                    @endif
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow "
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 ">{{ Auth::user()->username }}</span>
                        <span
                            class="block text-sm  text-gray-500 truncate ">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ route('users.show', Auth::user()->id) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Ver
                                perfil</a>
                        </li>
                        <li>
                            <a href="{{ route('users.edit', Auth::user()->id) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Editar
                                perfil</a>
                        </li>
                        @if (Auth::user()->role == 'artist')
                            <li>
                                <a href="{{ route('publications.create') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Publicar</a>
                            </li>
                            <li>
                                <a href="{{ route('bookings.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Reservas</a>
                            </li>
                        @endif
                        @if (Auth::user()->role == 'admin')
                            <li>
                                <a href="{{ route('events.create') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Crear evento</a>
                            </li>
                            <li>
                                <a href="{{ route('contactMessages.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Ver incidencias</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('chats.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Ver chats</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Sign
                                out</a>
                        </li>
                    </ul>
                </div>
        @endif
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
        @if (Auth::check())
            </div>
        @endif
        {{-- PRINCIPAL MENU --}}
        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1 order-4" id="mobile-menu-2">
            <ul
                class="flex flex-col font-medium p-4 lg:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-transparent">
                <li>
                    <a href="{{ route('users.index') }}"
                        class="block py-2 pl-3 pr-4 text-black lg:text-white text rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-blue-700 lg:p-0  ">Artistas</a>
                </li>
                <li>
                    <a href="{{ route('publications.index') }}"
                        class="block py-2 pl-3 pr-4 text-black lg:text-white text rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-blue-700 lg:p-0  ">Multimedia</a>
                </li>
                <li>
                    <a href="{{ route('events.index') }}"
                        class="block py-2 pl-3 pr-4 text-black lg:text-white text rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-blue-700 lg:p-0  ">Eventos</a>
                </li>
                @if ((Auth::check() && Auth::user()->role == 'user') || !Auth::check())
                    <li>
                        <a href="{{ route('contactMessages.create') }}" class="block py-2 pl-3 pr-4 text-black lg:text-white text rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-blue-700 lg:p-0  ">Trabaja con nosotros</a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('contactMessages.create') }}" class="block py-2 pl-3 pr-4 text-black lg:text-white text rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-blue-700 lg:p-0  ">Contacto</a>
                </li>
                @if (!Auth::check())
                    <li>
                        <a href="{{ route('login') }}" class="block py-2 pl-3 pr-4 text-black lg:text-white text rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-blue-700 lg:p-0  ">Log In</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
