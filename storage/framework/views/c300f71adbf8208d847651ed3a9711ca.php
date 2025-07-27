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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"><?php echo e($car->make); ?> <?php echo e($car->model); ?></h2>
            <a href="<?php echo e(route('cars.index')); ?>" class="px-4 py-2 bg-gray-600 text-white rounded">Back</a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto py-6 px-4 space-y-6">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <?php if($car->image_path): ?>
                <img src="<?php echo e(Storage::url($car->image_path)); ?>" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?>" class="w-full h-64 object-cover">
            <?php endif; ?>
            <div class="p-6">
                <h3 class="text-2xl font-bold mb-4"><?php echo e($car->year); ?> <?php echo e($car->make); ?> <?php echo e($car->model); ?></h3>
                <p class="mb-4"><?php echo e($car->description); ?></p>
                <ul class="space-y-2">
                    <li><strong>Seats:</strong> <?php echo e($car->seats); ?></li>
                    <?php if($car->price_per_day > 0): ?>
                        <li><strong>Price per Day:</strong> <?php echo e($car->price_per_day); ?> ETB</li>
                    <?php endif; ?>
                    <?php if($car->price_per_week > 0): ?>
                        <li><strong>Price per Week:</strong> <?php echo e($car->price_per_week); ?> ETB</li>
                    <?php endif; ?>
                    <?php if($car->price_per_month > 0): ?>
                        <li><strong>Price per Month:</strong> <?php echo e($car->price_per_month); ?> ETB</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->id() !== $car->user_id): ?>
            <div class="max-w-4xl mx-auto py-6 px-4">
                <a href="<?php echo e(route('cars.rent.create', $car)); ?>"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Rent this Car
                </a>
            </div>
        <?php endif; ?>
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
<?php /**PATH C:\Users\lisan\Herd\Car_Rental\resources\views/cars/show.blade.php ENDPATH**/ ?>