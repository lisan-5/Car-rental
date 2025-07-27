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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rent <?php echo e($car->make); ?> <?php echo e($car->model); ?></h2>
            <a href="<?php echo e(route('cars.show', $car)); ?>" class="px-4 py-2 bg-gray-600 text-white rounded">Back</a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow p-6">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="<?php echo e(route('cars.rent', $car)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name"
                           value="<?php echo e(old('name', auth()->user()->name)); ?>"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                           value="<?php echo e(old('email', auth()->user()->email)); ?>"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration of Rent</label>
                    <input type="text" name="duration" id="duration"
                           value="<?php echo e(old('duration')); ?>"
                           placeholder="e.g., 3 days, 1 week"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Your Message (optional)</label>
                    <textarea name="message" id="message" rows="3"
                              class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                              placeholder="Any special requests or notes"><?php echo e(old('message')); ?></textarea>
                </div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 rounded text-white hover:bg-blue-700">
                    Submit Request
                </button>
            </form>
        </div>
    </div>
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
<?php /**PATH C:\Users\lisan\Herd\Car_Rental\resources\views/cars/rent.blade.php ENDPATH**/ ?>