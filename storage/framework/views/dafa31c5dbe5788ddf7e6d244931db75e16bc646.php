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
        body {
            background: url('<?php echo e(asset('img/admin/agsquare.png')); ?>');
            position: absolute;
            width: 100%;
            height: 100%;
        }

        img.icon {
            width: 100px;
            margin: 0 auto;
            display: block;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
            <img class="icon mb-2" src="<?php echo e(config('site.icon')); ?>">
            <h4 class="text-center mb-3">Login</h4>
            <form action="<?php echo e(route('admin.login.authenticate')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <?php if($returnLocation): ?>
                    <input type="hidden" name="return_location" value="<?php echo e($returnLocation); ?>">
                <?php endif; ?>

                <label for="username" style="font-weight:600;margin-bottom:5px;">Username</label>
                <input class="form-control mb-2" type="text" name="username" placeholder="Username" required>
                <label for="username" style="font-weight:600;margin-bottom:5px;">Password</label>
                <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>

                <?php if(config('site.admin_panel_code')): ?>
                    <label for="username" style="font-weight:600;margin-bottom:5px;">Secret Code</label>
                    <input class="form-control mb-2" type="password" name="code" placeholder="Code" required>
                <?php endif; ?>

                <div class="mb-3"></div>
                <button class="btn btn-block btn-success" type="submit">Login</button>
            </form>
        </div>
    </div>
    <a href="<?php echo e(route('home.index')); ?>">Return to <?php echo e(config('site.name')); ?></a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
    'title' => 'Login'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/login.blade.php ENDPATH**/ ?>