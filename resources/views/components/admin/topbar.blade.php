<header class="flex items-center justify-between border-b border-gray-200 bg-white px-6 py-3 shadow-sm">
    <div class="flex items-center gap-4">
        <button type="button" class="rounded-md p-1.5 text-gray-600 hover:bg-gray-100 lg:hidden" aria-label="Menu">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="flex items-center gap-3">
            <div class="flex -space-x-2">
                <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-white bg-up-maroon text-[8px] font-bold leading-tight text-white shadow-sm">
                    UP<br>Cebu
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-white bg-yellow-500 text-[8px] font-bold text-up-maroon shadow-sm">
                    UP
                </div>
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-semibold text-up-maroon">University of the Philippines Cebu</p>
                <p class="text-base font-bold text-gray-900">AMIS</p>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <button type="button" class="relative rounded-full p-2 text-gray-500 hover:bg-gray-100" aria-label="Notifications">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
        </button>

        <div class="flex items-center gap-3">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-up-maroon/10 text-sm font-semibold text-up-maroon">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="hidden text-sm font-medium text-gray-800 sm:inline">{{ auth()->user()->name }}</span>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
            @csrf
            <button type="submit" class="text-xs text-gray-500 hover:text-up-maroon">Sign out</button>
        </form>
    </div>
</header>
