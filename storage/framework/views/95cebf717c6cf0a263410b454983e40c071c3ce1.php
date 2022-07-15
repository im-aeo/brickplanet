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
    <h3><?php echo e(config('site.membership_name')); ?> Membership</h3>
    <div class="row text-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo e($image); ?>" width="48%">
                    <div class="mb-3"></div>
                    <a href="<?php echo e(route('account.upgrade.checkout', str_replace('_', '-', $products['membership']['item_name']))); ?>" class="btn" style="background:<?php echo e(config('site.membership_bg_color')); ?>;color:<?php echo e(config('site.membership_color')); ?>;" type="submit" <?php if(Auth::user()->hasMembership()): ?> disabled <?php endif; ?>>Buy for $<?php echo e($products['membership']['price']); ?>/month</a>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div>Join and create <?php echo e(config('site.group_limit_membership')); ?> spaces instead of <?php echo e(config('site.group_limit')); ?></div>
                    <hr>
                    <div><?php echo e(config('site.daily_currency_membership')); ?> daily currency instead of <?php echo e(config('site.daily_currency')); ?></div>
                    <hr>
                    <div><?php echo e(config('site.membership_name')); ?> tag below your username on the forums</div>
                    <hr>
                    <div>Donator and Membership badges</div>
                    <hr>
                    <div>Donator item</div>
                </div>
            </div>
        </div>
    </div>
    <h3>Currency</h3>
    <div class="row justify-content-center">
        <?php $__empty_1 = true; $__currentLoopData = $products['currency']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4 text-center">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-2" style="font-weight:600;"><i class="currency"></i> <?php echo e($product['display_name']); ?></h4>
                        <a href="<?php echo e(route('account.upgrade.checkout', str_replace('_', '-', $product['item_name']))); ?>" class="btn btn-success" type="submit">Buy for $<?php echo e($product['price']); ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col">No currency products found.</div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Upgrade'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/upgrade/index.blade.php ENDPATH**/ ?>