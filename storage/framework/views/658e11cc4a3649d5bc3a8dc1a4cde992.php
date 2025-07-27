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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Car</h2>
            <a href="<?php echo e(route('cars.index')); ?>" class="px-4 py-2 bg-gray-600 text-white rounded">Back</a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-3xl mx-auto py-6 px-4">
        <form action="<?php echo e(route('cars.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php echo csrf_field(); ?>
            <!-- Make -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Make</label>
                <input type="text" name="make" value="<?php echo e(old('make')); ?>" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Model -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" name="model" value="<?php echo e(old('model')); ?>" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Year -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" name="year" value="<?php echo e(old('year')); ?>" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Rate Option -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Rate Option</label>
                <select name="price_type" id="price_type" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="per_day" <?php echo e(old('price_type')=='per_day'?'selected':''); ?>>Per Day</option>
                    <option value="per_week" <?php echo e(old('price_type')=='per_week'?'selected':''); ?>>Per Week</option>
                    <option value="per_month" <?php echo e(old('price_type')=='per_month'?'selected':''); ?>>Per Month</option>
                </select>
            </div>
            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" name="price" value="<?php echo e(old('price')); ?>" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Seats -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Seats</label>
                <input type="number" name="seats" value="<?php echo e(old('seats')); ?>" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" required><?php echo e(old('description')); ?></textarea>
            </div>
            <!-- Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" class="mt-1 block w-full" accept="image/*">
            </div>
            <!-- Submit -->
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 rounded-md">Save Car</button>
            </div>
        </form>
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
<?php /**PATH C:\Users\lisan\Herd\Car_Rental\resources\views/cars/create.blade.php ENDPATH**/ ?>