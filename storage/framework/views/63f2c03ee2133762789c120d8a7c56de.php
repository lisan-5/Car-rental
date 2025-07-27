<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Home')); ?>

            </h2>
            <?php if(auth()->guard()->check()): ?>
                <div class="space-x-2">
                    <a href="<?php echo e(route('cars.index')); ?>" class="px-4 py-2 text-white  bg-gray-600  rounded-md hover:bg-gray-700 transition">View Cars</a>
                    <a href="<?php echo e(route('cars.create')); ?>" class="px-4 py-2 text-white  bg-blue-600  rounded-md hover:bg-blue-700 transition">Add Car</a>
                </div>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>
    <?php if(auth()->guard()->guest()): ?>

    
        <!-- Guest Hero -->
        <section class="flex flex-col items-center justify-center py-12 bg-gray-100 text-center px-4 space-y-4">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-2">Welcome to <?php echo e(config('app.name')); ?></h1>
            <p class="text-lg text-gray-700 mb-4 max-w-lg">Experience hassle-free car rentals with premium service and great deals.</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="<?php echo e(route('register')); ?>" class="px-6 py-3 text-white bg-indigo-600 hover:bg-indigo-700 text-base font-semibold rounded-lg shadow transition transform hover:scale-105">
                    Register
                </a>
                <a href="<?php echo e(route('login')); ?>" class="px-6 py-3 text-white bg-yellow-500 hover:bg-yellow-600 text-base font-semibold rounded-lg shadow transition transform hover:scale-105">
                    Login
                </a>
            </div>
        </section>
        <section class="py-12 bg-white">
            <div class="max-w-4xl mx-auto text-center px-6">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">About Our Rentals</h2>
                <p class="text-gray-600 leading-relaxed">Choose from a diverse fleet, enjoy competitive pricing, and a seamless booking experience. We make renting a car simple and reliable for every journey.</p>
            </div>
        </section>
        <footer class="bg-gray-100 py-6 text-center text-gray-700">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All rights reserved. | <a href="contact" class="underline">Contact Us</a> </p>
        </footer>
    <?php else: ?>


    <!-- Authenticated Content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h1 class="text-2xl font-semibold text-gray-800">Hello, <?php echo e(Auth::user()->name); ?>!</h1>
                    <p class="mt-4 text-gray-600">Welcome! Use the navigation above to view or add cars.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\lisan\Herd\Car_Rental\resources\views/home.blade.php ENDPATH**/ ?>