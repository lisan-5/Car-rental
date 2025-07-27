<nav x-data="{ open: false }" class="bg-white shadow-md">
  <div class="container mx-auto flex justify-between items-center px-4 py-3">
    <!-- Logo -->
    <a href="<?php echo e(route('home')); ?>" class="text-2xl font-bold text-blue-600">
      <?php echo e(config('app.name', 'Car Rental')); ?>

    </a>

    <!-- Desktop Links -->
    <div class="hidden md:flex space-x-6">
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('cars.index')); ?>"
           class="px-3 py-2 rounded-md <?php echo e(request()->routeIs('cars.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600'); ?>">
          Cars
        </a>
        <a href="<?php echo e(route('dashboard')); ?>"
           class="px-3 py-2 rounded-md <?php echo e(request()->routeIs('dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600'); ?>">
          Dashboard
        </a>
        <a href="<?php echo e(route('mycart')); ?>"
           class="px-3 py-2 rounded-md <?php echo e(request()->routeIs('mycart') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600'); ?>">
          My Cart
        </a>
        <a href="<?php echo e(route('contact')); ?>"
           class="px-3 py-2 rounded-md <?php echo e(request()->routeIs('contact') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-00'); ?>">
          Contact
        </a>
      <?php endif; ?>
    </div>

    <!-- Auth & Mobile Toggle -->
    <div class="flex items-center space-x-4">
      <?php if(auth()->guard()->guest()): ?>
      <?php else: ?>
        <div class="relative" x-data="{ dropdown: false }">
          <button @click="dropdown = ! dropdown"
                  class="flex items-center space-x-1 text-gray-600 hover:text-blue-600 focus:outline-none">
            <span><?php echo e(Auth::user()->name); ?></span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="dropdown" @click.away="dropdown = false"
               class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg py-1">
            <a href="<?php echo e(route('profile.edit')); ?>"
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
            <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
              <button type="submit"
                      class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                Logout
              </button>
            </form>
          </div>
        </div>
      <?php endif; ?>

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
    <?php if(auth()->guard()->check()): ?>
      <a href="<?php echo e(route('cars.index')); ?>"
         class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Cars</a>
      <a href="<?php echo e(route('dashboard')); ?>"
         class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Dashboard</a>
      <a href="<?php echo e(route('mycart')); ?>"
         class="block px-4 py-2 text-gray-600 hover:bg-gray-100">My Cart</a>
      <a href="<?php echo e(route('profile.edit')); ?>"
         class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profile</a>
      <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
        <button type="submit"
                class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100">
          Logout
        </button>
      </form>
    <?php endif; ?>
  </div>
</nav>
<?php /**PATH C:\Users\lisan\Herd\Car_Rental\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>