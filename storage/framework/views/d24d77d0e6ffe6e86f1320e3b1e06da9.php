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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"><?php echo e(__('Cars')); ?></h2>
            <a href="<?php echo e(route('cars.create')); ?>" class="px-4 py-2 bg-blue-600 text-white rounded">Add Car</a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <?php if(session('success')): ?>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 ">
                <?php $__empty_1 = true; $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="relative bg-white shadow rounded-lg overflow-hidden flex flex-col">

                        <div class="absolute top-2 right-2 <?php echo e(auth()->id() === $car->user_id ? 'bg-blue-600 text-white' : 'bg-gray-800 text-white'); ?> text-xs px-2 py-1 rounded z-10">
                            <?php echo e(auth()->id() === $car->user_id ? 'You' : $car->user->name); ?>

                        </div>
                        <?php if($car->image_path): ?>
                            <img src="<?php echo e(Storage::url($car->image_path)); ?>" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?>" class="h-48 w-full object-cover">
                        <?php else: ?>
                            <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                        <?php endif; ?>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-semibold"><?php echo e($car->year); ?> <?php echo e($car->make); ?> <?php echo e($car->model); ?></h3>
                                <p class="mt-2 text-gray-600 text-sm line-clamp-3"><?php echo e($car->description); ?></p>
                            </div>
                            <!-- Detailed info hidden on index; view full details on show page -->
                            <div class="mt-4 flex flex-wrap space-x-2">
                                <a href="<?php echo e(route('cars.show', $car)); ?>" class="px-2 py-1 bg-blue-800 text-white text-sm rounded">More...</a>
                                <?php if(auth()->id() === $car->user_id): ?>
                                    <a href="<?php echo e(route('cars.edit', $car)); ?>" class="px-2 py-1 bg-green-600 text-white text-sm rounded">Edit</a>
                                <?php endif; ?>
                                <?php if(auth()->check() && auth()->id() !== $car->user_id && !in_array($car->id, $cartIds)): ?>
                                    <form action="<?php echo e(route('cart.store')); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="car_id" value="<?php echo e($car->id); ?>">
                                        <button type="submit" class="px-2 py-1 bg-yellow-500 text-white text-sm rounded">Add to Cart</button>
                                    </form>
                                <?php endif; ?>
                                <?php if(auth()->id() === $car->user_id): ?>
                                    <button type="button"
                                            class="open-delete-modal px-2 py-1 text-white bg-red-600  text-sm rounded"
                                            data-id="<?php echo e($car->id); ?>"
                                            data-make="<?php echo e($car->make); ?>"
                                            data-model="<?php echo e($car->model); ?>"
                                            data-created="<?php echo e($car->created_at->format('F j, Y')); ?>">
                                        Delete
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="col-span-full text-center text-gray-500">No cars available.</p>
                <?php endif; ?>
            </div>
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

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
        <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
        <p id="delete-modal-info" class="mb-4 text-gray-700"></p>
        <div class="flex justify-end space-x-3">
            <button id="cancel-delete" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
            <form id="delete-form" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>
</div>
<!-- By JS -->

<script>
    document.querySelectorAll('.open-delete-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const make = btn.dataset.make;
            const model = btn.dataset.model;
            const created = btn.dataset.created;
            // Set modal info
            document.getElementById('delete-modal-info').textContent =
                `Car: ${make} ${model} (Created: ${created})`;
            // Set form action
            document.getElementById('delete-form').action = `/cars/${id}`;
            // Show modal
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });
    // Cancel button
    document.getElementById('cancel-delete').addEventListener('click', () => {
        const modal = document.getElementById('delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });
</script>
<?php /**PATH C:\Users\lisan\Herd\Car_Rental\resources\views/cars/index.blade.php ENDPATH**/ ?>