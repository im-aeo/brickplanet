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



<?php $__env->startSection('css'); ?>
    <style>
        img.user-headshot {
            background: var(--section_bg);
            border-radius: 6px;
            width: 50px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <ul class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="<?php echo e(route('forum.index')); ?>">Forum</a></li>
                <li class="breadcrumb-item active">New <?php echo e(ucfirst($type)); ?></li>
            </ul>
            <div class="card">
                <div class="card-header bg-primary text-white"><?php echo e($title); ?></div>
                <div class="card-body">
                    <form action="<?php echo e(route('forum.create')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($id); ?>">
                        <input type="hidden" name="type" value="<?php echo e($type); ?>">

                        <?php if($quote): ?>
                            <div class="card has-bg">
                                <div class="card-body">
                                    <div class="row no-gutters">
                                        <div class="col-auto pr-3 hide-sm">
                                            <a href="<?php echo e(route('users.profile', $quote->creator->username)); ?>">
                                                <img class="user-headshot" src="<?php echo e($quote->creator->headshot()); ?>">
                                            </a>
                                        </div>
                                        <div class="col">
                                            <div><?php echo e($quote->created_at->diffForHumans()); ?>, <a href="<?php echo e(route('users.profile', $quote->creator->username)); ?>"><?php echo e($quote->creator->username); ?></a> wrote:</div>
                                            <div class="text-italic"><?php echo nl2br(e($quote->body)); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($type == 'thread'): ?>
                            <label for="title">Title</label>
                            <input class="form-control mb-2" type="text" name="title" placeholder="Title" required>
                        <?php endif; ?>

                        <label for="body">Body</label>
                        <textarea class="form-control mb-3" name="body" placeholder="Write your post here..." rows="5" required></textarea>
                        <button class="btn btn-block btn-success" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => $title
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/forum/new.blade.php ENDPATH**/ ?>