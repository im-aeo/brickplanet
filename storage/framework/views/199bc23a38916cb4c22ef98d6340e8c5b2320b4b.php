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
            background: var(--headshot_bg);
            border-radius: 50%;
            width: 50%;
            margin: 0 auto;
            display: block;
        }

        @media  only screen and (min-width: 768px) {
            img.user-headshot {
                width: 60%;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <a href="<?php echo e(route('users.profile', $message->sender->username)); ?>">
                                <img class="user-headshot" src="<?php echo e($message->sender->headshot()); ?>">
                                <div class="text-truncate text-center"><?php echo e($message->sender->username); ?></div>
                            </a>

                            <?php if($message->sender->id != Auth::user()->id): ?>
                                <a href="<?php echo e(route('account.inbox.new', ['reply', $message->id])); ?>" class="btn btn-block btn-success mt-2 mb-3">Reply</a>
                            <?php endif; ?>

                            <?php if($message->sender->id != Auth::user()->id && !$message->sender->isStaff() && $message->receiver->id == Auth::user()->id): ?>
                                <div class="text-center">
                                    <a href="<?php echo e(route('report.index', ['message', $message->id])); ?>" class="text-danger">
                                        <i class="fas fa-flag"></i>
                                        <span>Report</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <h3><strong><?php echo e($message->title); ?></strong></h3>
                            <h5>Received on <?php echo e($message->created_at->format('M d, Y h:i A')); ?></h5>
                            <hr>
                            <?php echo nl2br(e($message->body)); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => $message->title
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/inbox/message.blade.php ENDPATH**/ ?>