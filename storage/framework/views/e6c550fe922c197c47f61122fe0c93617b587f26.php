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



<?php $__env->startSection('content'); ?>
    <h3><?php echo e($user->username); ?>'s Friends</h3>
    <div class="card">
        <div class="card-body" <?php if($friends->count() > 0): ?> style="padding-bottom:0;" <?php endif; ?>>
            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-6 col-md-2">
                        <div class="card text-center" style="border:none;">
                            <a href="<?php echo e(route('users.profile', $friend->username)); ?>">
                                <img src="<?php echo e($friend->thumbnail()); ?>">
                                <div class="text-truncate mt-1"><?php echo e($friend->username); ?></div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col text-center">
                        <i class="fas fa-frown text-warning mb-2" style="font-size:50px;"></i>
                        <div>This user has no friends. What a party pooper!</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php echo e($friends->onEachSide(1)); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => "{$user->username}'s Friends"
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/users/friends.blade.php ENDPATH**/ ?>