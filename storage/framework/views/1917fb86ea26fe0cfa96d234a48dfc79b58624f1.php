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
    <?php if($type == 'currency'): ?>
        <div class="row">
            <?php if(staffUser()->staff('can_give_currency')): ?>
                <div class="col-md">
                    <h3>Give Currency</h3>
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.users.manage.update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                <input type="hidden" name="action" value="give_currency">
                                <input class="form-control mb-3" name="amount" type="number" min="1" placeholder="Amount" required>
                                <button class="btn btn-success" type="submit">Give</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(staffUser()->staff('can_take_currency')): ?>
                <div class="col-md">
                    <h3>Take Currency</h3>
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.users.manage.update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                <input type="hidden" name="action" value="take_currency">
                                <input class="form-control mb-3" name="amount" type="number" min="1" placeholder="Amount" required>
                                <button class="btn btn-danger" type="submit">Take</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php elseif($type == 'inventory'): ?>
        <div class="row">
            <?php if(staffUser()->staff('can_give_items')): ?>
                <div class="col-md">
                    <h3>Give Item</h3>
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.users.manage.update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                <input type="hidden" name="action" value="give_items">
                                <input class="form-control mb-3" name="item_id" type="number" min="1" placeholder="Item ID" required>
                                <button class="btn btn-success" type="submit">Give</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(staffUser()->staff('can_take_items')): ?>
                <div class="col-md">
                    <h3>Take Item</h3>
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.users.manage.update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                <input type="hidden" name="action" value="take_items">
                                <input class="form-control mb-3" name="item_id" type="number" min="1" placeholder="Item ID" required>
                                <button class="btn btn-danger" type="submit">Take</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
    'title' => $title
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/users/manage.blade.php ENDPATH**/ ?>