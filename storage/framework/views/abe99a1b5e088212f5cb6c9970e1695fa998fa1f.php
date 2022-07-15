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
<style>
    body{
        background-image: url('/img/bpbg.jpg?v=2');
        background-size: cover;
        background-position: center;
    }
</style>
<div class="video-content">
<div class="content-title">Maintenance</div>
<div class="content-subtitle">We will be back up soon!</div>

<div class="content-links auth-menu">
  
<?php if(count($errors) > 0): ?>
        <div class="alert bg-danger text-white">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><?php echo $error; ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    
    <form action="<?php echo e(route('maintenance.authenticate')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="input-group">
            <input class="form-control" type="password" name="password" placeholder="Developer Password">
            <div class="input-group-append">
                <a class="button button-green" aria-label="submit form" href="javascript:void(0)" onclick="document.querySelector('form').submit()">Login</a>
            </div>
        </div>
    </form>
    <?php if(config('site.socials.discord') || config('site.socials.twitter')): ?>
            <div class="mt-2">
                <?php if(config('site.socials.discord')): ?>
                    <a href="<?php echo e(config('site.socials.discord')); ?>" style="color:#7289da;font-size:40px;text-decoration:none;" title="Join our Discord server!" target="_blank" data-toggle="tooltip">
                        <i class="fab fa-discord"></i>
                    </a>
                <?php endif; ?>

                <?php if(config('site.socials.twitter')): ?>
                    <a href="<?php echo e(config('site.socials.twitter')); ?>" style="color:#00acee;font-size:43px;text-decoration:none;" title="Follow us on Twitter!" target="_blank" data-toggle="tooltip">
                        <i class="fab fa-twitter-square"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
                
              </a>
            </div>
              
        </div>
    </form>
    
  </div>
</div>

    
   
<div class="site-footer"><span>© Copyright <?php echo e(date('Y')); ?> <?php echo e(config('site.name')); ?> All rights reserved.</span></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.error', [
    'title' => 'Maintenance'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/maintenance/index.blade.php ENDPATH**/ ?>