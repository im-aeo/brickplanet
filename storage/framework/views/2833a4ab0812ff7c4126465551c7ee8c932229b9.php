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
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            width: 70%;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h3>Trades</h3>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item">
                    <a href="<?php echo e(route('account.trades.index', 'incoming')); ?>" class="nav-link <?php if($category == 'incoming'): ?> active <?php endif; ?>">Incoming</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('account.trades.index', 'sent')); ?>" class="nav-link <?php if($category == 'sent'): ?> active <?php endif; ?>">Sent</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('account.trades.index', 'history')); ?>" class="nav-link <?php if($category == 'history'): ?> active <?php endif; ?>">History</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card">
        <div class="card-body" <?php if($trades->count() > 0): ?> style="padding-bottom:0;" <?php endif; ?>>
            <?php $__empty_1 = true; $__currentLoopData = $trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card has-bg text-center-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 hide-sm">
                                <a href="<?php echo e(route('users.profile', ($trade->receiver->id == Auth::user()->id) ? $trade->sender->username : $trade->receiver->username)); ?>">
                                    <img class="user-headshot" src="<?php echo e(($trade->receiver->id == Auth::user()->id) ? $trade->sender->headshot() : $trade->receiver->headshot()); ?>">
                                </a>
                            </div>
                            <div class="col-md-8 align-self-center">
                                <?php if($trade->receiver->id == Auth::user()->id): ?>
                                    <h5>Sent by <a href="<?php echo e(route('users.profile', $trade->sender->username)); ?>"><?php echo e($trade->sender->username); ?></a></h5>
                                <?php else: ?>
                                    <h5>Sent to <a href="<?php echo e(route('users.profile', $trade->receiver->username)); ?>"><?php echo e($trade->receiver->username); ?></a></h5>
                                <?php endif; ?>

                                <h5 style="margin-bottom:0;"><?php echo e($trade->created_at->diffForHumans()); ?></h5>

                                <?php if($category == 'history'): ?>
                                    <h5 class="mt-2 text-<?php echo e(($trade->status == 'accepted') ? 'success' : 'danger'); ?>" style="margin-bottom:0;"><?php echo e(ucfirst($trade->status)); ?></h5>
                                <?php endif; ?>

                                <div class="mb-3 show-sm-only"></div>
                            </div>
                            <div class="col-md-2 align-self-center text-right">
                                <a href="<?php echo e(route('account.trades.view', $trade->id)); ?>" class="btn btn-block btn-success">View Trade</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p><?php echo e($error); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php echo e($trades->onEachSide(1)); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Trades'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/trades/index.blade.php ENDPATH**/ ?>