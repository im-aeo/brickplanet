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
        @media  only screen and (max-width: 768px) {
            img.referrer {
                width: 50%;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php if(config('app.env') == 'production' && site_setting('registration_enabled')): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(!site_setting('registration_enabled')): ?>
        <p>Account creation is currently disabled.</p>
    <?php else: ?>
        <div class="grid-x grid-margin-x align-middle">
		<div class="large-6 large-offset-3 medium-12 small-12 cell">
                <h4>Register</h4>
                <div class="container lg-padding border-r login-form">
                       
                        <form action="<?php echo e(route('auth.register.authenticate')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <?php if($referred): ?>
                                <input type="hidden" name="referral_code" value="<?php echo e($referralCode); ?>">
                            <?php endif; ?>

                            
                            <input type="text" name="username" placeholder="Username" required>
                            <div style="height:5px;"></div>
                            
                            <input class="form-control mb-2" type="text" name="email" placeholder="Email Address" required>
                          
                            
                          
                            <input  type="password" name="password" placeholder="Password" required>
                            
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            <?php if(config('app.env') == 'production'): ?>
                                <div class="mt-3 mb-3">
                                    <?php echo NoCaptcha::display(['data-theme' => 'dark']); ?>

                                </div>
                            <?php endif; ?>
                            <input class="button-green" type="submit" value="Register">
                        </form>
                    </div>
                </div>
            </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => $title,
    'image' => $icon
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/auth/register.blade.php ENDPATH**/ ?>