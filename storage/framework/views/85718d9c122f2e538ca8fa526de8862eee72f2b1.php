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



<?php $__env->startSection('meta'); ?>
    <meta name="routes" data-redeem="<?php echo e(route('account.promocodes.redeem')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/promocodes.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-4">
            <h4>How It Works</h4>
            <div class="card">
                <div class="card-body">
                    <p>Enter special codes in the text box and press the button for unique and special items!</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h4>Promocodes</h4>
            <div class="card">
                <div class="card-body">
                    <form id="codeForm">
                        <div class="input-group">
                            <input class="form-control" type="text" name="code" placeholder="Code" required>
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Redeem</button>
                            </div>
                        </div>
                    </form>
                    <div id="message"></div>
                </div>
            </div>
            <h4>Current Code Items</h4>
            <div class="card">
                <div class="card-body" <?php if(count($items) > 0): ?> style="padding-bottom:0;" <?php endif; ?>>
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-4 col-md-3">
                                <div class="card has-bg" style="border:none;padding:<?php echo e(itemTypePadding($item->type)); ?>;">
                                    <a href="<?php echo e(route('catalog.item', [$item->id, $item->slug()])); ?>" target="_blank">
                                        <img src="<?php echo e($item->thumbnail()); ?>">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col">There are currently no code items.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Promocodes'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/promocodes.blade.php ENDPATH**/ ?>