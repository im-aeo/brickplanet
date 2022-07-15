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
    <a href="<?php echo e(route('admin.manage.forum_topics.new')); ?>" class="btn btn-success"><i class="fas fa-plus"></i></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($topics->count() == 0): ?>
        <p>No forum topics were found.</p>
    <?php else: ?>
        <div class="card" style="border:0;">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Posts</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="<?php echo e(route('admin.manage.forum_topics.edit', $topic->id)); ?>"><?php echo e($topic->id); ?></a></td>
                            <td><a href="<?php echo e(route('admin.manage.forum_topics.edit', $topic->id)); ?>"><?php echo e($topic->name); ?></a></td>
                            <td><?php echo e($topic->created_at); ?></td>
                            <td><?php echo e(number_format($topic->threads()->count())); ?></td>
                            <td><a href="<?php echo e(route('admin.manage.forum_topics.confirm_delete', $topic->id)); ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($topics->onEachSide(1)); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
    'title' => 'Manage Forum Topics'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/manage/forum_topics/index.blade.php ENDPATH**/ ?>