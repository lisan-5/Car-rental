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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
     <?php $__env->endSlot(); ?>

    <?php
        // Initialize cars if not provided
        $cars = $cars ?? collect();
    ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">My Cars</h3>
                <a href="<?php echo e(route('cars.create')); ?>" class="px-4 py-2 text-white bg-blue-600  rounded">Add New Car</a>
            </div>
            <?php if($cars->isEmpty()): ?>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-600">
                    You have not posted any cars yet.
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                            <?php if($car->image_path): ?>
                                <img src="<?php echo e(Storage::url($car->image_path)); ?>" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?>" class="h-40 w-full object-cover">
                            <?php else: ?>
                                <div class="h-40 w-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                            <?php endif; ?>
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h4 class="text-md font-semibold"><?php echo e($car->year); ?> <?php echo e($car->make); ?> <?php echo e($car->model); ?></h4>
                                </div>
                                <div class="mt-4 flex space-x-2">
                                    <a href="<?php echo e(route('cars.edit', $car)); ?>" class="px-2 py-1 bg-green-600 text-white text-sm rounded">Edit</a>
                                    <form action="<?php echo e(route('cars.destroy', $car)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white text-sm rounded">Delete</button>
                                    </form>
                                    <form action="<?php echo e(route('cars.toggleRent', $car)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit"
                                                class="px-2 py-1 bg-yellow-500  text-white text-sm rounded">
                                            <?php echo e($car->is_rented ? 'Mark Available' : 'Mark Rented'); ?>

                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <!-- Rental Requests Section -->
            <div class="mt-12">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Rental Requests</h3>
                </div>
                <?php if(isset($requests) && $requests->isEmpty()): ?>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-600">
                        No rental requests at this time.
                    </div>
                <?php elseif(isset($requests)): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($status = $request->status); ?>
                            <div class="bg-white shadow rounded-lg p-4 flex justify-between items-start <?php echo e($status != 'pending' ? 'opacity-50 pointer-events-none' : ''); ?>">
                                <div class="flex-1">
                                    <p><strong>Car:</strong> <?php echo e($request->car->make); ?> <?php echo e($request->car->model); ?></p>
                                    <p><strong>From:</strong> <?php echo e($request->name); ?> (<?php echo e($request->email); ?>)</p>
                                    <p><strong>Duration:</strong> <?php echo e($request->duration); ?></p>
                                    <?php if($request->message): ?>
                                        <p><strong>Message:</strong> <?php echo e($request->message); ?></p>
                                    <?php endif; ?>
                                    <p class="text-xs text-gray-500">Requested on <?php echo e($request->created_at->format('F j, Y')); ?></p>
                                </div>
                                <div class="ml-4 flex flex-col space-y-2">
                                    <?php if($status == 'accepted'): ?>
                                        <span class="px-3 py-1 bg-green-600  text-sm rounded">Accepted</span>
                                    <?php elseif($status == 'rejected'): ?>
                                        <span class="px-3 py-1 bg-red-600 text-white text-sm rounded">Rejected</span>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('cars.show', $request->car)); ?>" class="px-3 py-1 bg-blue-600 text-sm rounded">View Car</a>
                                        <form action="<?php echo e(route('rentals.accept', $request)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="px-3 py-1 bg-green-600 text-sm rounded hover:bg-green-700">
                                                Accept
                                            </button>
                                        </form>
                                        <form action="<?php echo e(route('rentals.reject', $request)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                Reject
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
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
<?php /**PATH C:\Users\lisan\Herd\Car_Rental\resources\views/dashboard.blade.php ENDPATH**/ ?>