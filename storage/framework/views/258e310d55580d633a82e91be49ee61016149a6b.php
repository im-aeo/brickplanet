<!--
MIT License

Copyright (c) 2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->



<?php $__env->startSection('header'); ?>
    <a href="<?php echo e(route('admin.manage.staff.new')); ?>" class="btn btn-success"><i class="fas fa-plus"></i></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($users->count() == 0): ?>
        <p>No staff were found.</p>
    <?php else: ?>
        <div class="card" style="border:none;">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Since</th>
                        <th>Online</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="<?php echo e(route('admin.users.view', $user->user->id)); ?>"><?php echo e($user->id); ?></a></td>
                            <td><a href="<?php echo e(route('admin.users.view', $user->user->id)); ?>"><?php echo e($user->user->username); ?></a></td>
                            <td><?php echo e($user->created_at); ?></td>
                            <td><?php echo ($user->user->online()) ? '<span class="badge bg-success text-white">YES</span>' : '<span class="badge bg-danger text-white">NO</span>'; ?></td>
                            <td><a href="<?php echo e(route('admin.manage.staff.edit', $user->user->id)); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($users->onEachSide(1)); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
    'title' => 'Manage Staff'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/manage/staff/index.blade.php ENDPATH**/ ?>