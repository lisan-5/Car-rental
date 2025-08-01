<nav x-data="{ open: false }" class="bg-white shadow-md">
  <div class="container mx-auto flex justify-between items-center px-4 py-3">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
     Car Rental
    </a>

    <!-- Desktop Links -->
    <div class="hidden md:flex space-x-6">
      @auth
        @if(Auth::user()->is_admin)
          <a href="{{ route('admin.users.index') }}"
             class="px-3 py-2 rounded-md {{ request()->routeIs('admin.users.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
            Users
          </a>
          <a href="{{ route('admin.cars.index') }}"
             class="px-3 py-2 rounded-md {{ request()->routeIs('admin.cars.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
            Cars
          </a>
          <a href="{{ route('admin.rentals.index') }}"
             class="px-3 py-2 rounded-md {{ request()->routeIs('admin.rentals.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
            Requests
          </a>
        @else
          <a href="{{ route('cars.index') }}"
             class="px-3 py-2 rounded-md {{ request()->routeIs('cars.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
            Cars
          </a>
          <a href="{{ route('dashboard') }}"
             class="px-3 py-2 rounded-md {{ request()->routeIs('dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
            Dashboard
          </a>
          <a href="{{ route('mycart') }}"
             class="px-3 py-2 rounded-md {{ request()->routeIs('mycart') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
            My Cart
          </a>
          <a href="{{ route('contact') }}"
             class="px-3 py-2 rounded-md {{ request()->routeIs('contact') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600'}}">
            Contact
          </a>
          <a href="{{ route('rentals.index') }}"
             class="px-3 py-2 rounded-md {{ request()->routeIs('rentals.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600'}}">
            My Requests
          </a>
        @endif
      @endauth
    </div>

    <!-- Auth & Mobile Toggle -->
    <div class="flex items-center space-x-4">
      @guest
      @else
        <div class="relative" x-data="{ dropdown: false }">
          <button @click="dropdown = ! dropdown"
                  class="flex items-center space-x-1 text-blue-800 hover:text-blue-300 focus:outline-none">
            <span>{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="dropdown" @click.away="dropdown = false"
               class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg py-1">
            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}">@csrf
              <button type="submit"
                      class="w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100">
                Logout
              </button>
            </form>
          </div>
        </div>
      @endguest

      <!-- Mobile menu button -->
      <button @click="open = ! open"
              class="md:hidden text-gray-600 hover:text-blue-600 focus:outline-none">
        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div x-show="open" class="md:hidden bg-white border-t">
    @auth
      @if(Auth::user()->is_admin)
        <a href="{{ route('admin.users.index') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-300">
          Users
        </a>
        <a href="{{ route('admin.cars.index') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-300">
          Cars
        </a>
        <a href="{{ route('admin.rentals.index') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-300">
          Requests
        </a>
      @else
        <a href="{{ route('cars.index') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-300">Cars</a>
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-300">Dashboard</a>
        <a href="{{ route('mycart') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-300">My Cart</a>
        <a href="{{ route('rentals.index') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-300">My Requests</a>
      @endif
      <a href="{{ route('profile.edit') }}"
         class="block px-4 py-2 text-gray-600 hover:bg-gray-300">Profile</a>
      <form method="POST" action="{{ route('logout') }}">@csrf
        <button type="submit"
                class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-300">
          Logout
        </button>
      </form>
    @endauth
  </div>
</nav>
