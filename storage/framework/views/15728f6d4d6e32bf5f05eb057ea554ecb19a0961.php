<!--
MIT License
Copyright (c) 2022 Aeo
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
    <div class="grid-x grid-margin-x align-middle">
		<div class="large-6 large-offset-3 medium-12 small-12 cell">
            <h4>Login</h4>
			<div class="container lg-padding border-r login-form">
                <form action="<?php echo e(route('auth.login.authenticate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="username" placeholder="Username" required>
                    <div style="height:5px;"></div>
                    <input style="display:block;" type="password" name="password" placeholder="Password" required>
                    
                    <div style="padding-top:5px;"></div>
                    <input class="button-green" type="submit" value="Log in">
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Login'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/auth/login.blade.php ENDPATH**/ ?>