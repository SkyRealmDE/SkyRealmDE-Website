<nav>
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 font-sono">
        <div class="relative flex items-center justify-between h-48">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" onclick="toggleMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg id="icon-menu-closed" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="icon-menu-open" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <img class="block h-32 w-auto" src="/android-chrome-512x512.png" alt="SkyRealmDE">
                </div>
                <div class="hidden sm:block sm:ml-6 w-full">
                    <div class="flex justify-start md:justify-between">
                        <div>
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/" class="text-gray-100 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>

                            <a href="/team" class="text-gray-100 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Team</a>

                            <a href="/shop" class="text-gray-100 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Shop</a>

                            <a href="/stats" class="text-gray-100 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Statistiken</a>

                            <a href="/regelwerk" class="text-gray-100 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Regelwerk</a>

                        </div>
                        <div>
                            <a href="https://discord.gg/skyrealm" class="text-gray-100 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><i class="fa-brands fa-discord"></i></a>
                            <a href="https://instagram.com/skyrealmde" class="text-gray-100 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/@skyrealmde" class="text-gray-100 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><i class="fa-brands fa-tiktok"></i></a>
                        </div>
                    </div>
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/impressum" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{ trans('skyrealm.imprint') }}</a>

                            <a href="/agb" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{ trans('skyrealm.tos') }}</a>

                            <a href="/datenschutz" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{ trans('skyrealm.data-safety') }}</a>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>

            <a href="/team" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>

            <a href="/shop" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Shop</a>

            <a href="/stats" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Statistiken</a>

            <a href="/regelwerk" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Regelwerk</a>

            <a href="/impressum" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">{{ trans('skyrealm.imprint') }}</a>

            <a href="/agb" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">{{ trans('skyrealm.tos') }}</a>

            <a href="/datenschutz" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">{{ trans('skyrealm.data-safety') }}</a>
        </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        const element = document.getElementById("mobile-menu");
        element.classList.toggle("hidden");

        const iconMenuClosed = document.getElementById("icon-menu-closed");
        iconMenuClosed.classList.toggle("hidden");
        iconMenuClosed.classList.toggle("block");

        const iconMenuOpen = document.getElementById("icon-menu-open");
        iconMenuOpen.classList.toggle("hidden");
        iconMenuOpen.classList.toggle("block");
    }
</script>
