<nav class="fixed bottom-0 left-0 right-0 bg-white border-t shadow flex justify-around py-2 z-50">
    <button type="button"
            class="nav-btn flex flex-col items-center text-gray-500 hover:text-blue-600 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}"
            data-url="{{ route('home') }}"><span class="material-icons">home</span> <span class="text-xs">Home</span>
    </button>
    <button type="button"
            class="nav-btn flex flex-col items-center text-gray-500 hover:text-blue-600 {{ request()->routeIs('group') ? 'text-blue-600' : '' }}"
            data-url="{{ route('group') }}"><span class="material-icons">group</span> <span class="text-xs">Group</span>
    </button>
    <button type="button"
            class="nav-btn flex flex-col items-center text-gray-500 hover:text-blue-600 {{ request()->routeIs('settings') ? 'text-blue-600' : '' }}"
            data-url="{{ route('settings') }}"><span class="material-icons">settings</span> <span class="text-xs">Settings</span>
    </button>
</nav>
