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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(function() {
            $('input[name="invite_link"]').click(function() {
                this.select();
                document.execCommand('copy');

                toastr.success('Invite link copied to clipboard!');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-7">
            <h3>Invite</h3>
            <div class="card">
                <div class="card-body">
                    <p>Invite your friends to <?php echo e(config('site.name')); ?> to get rewarded and help us grow!</p>
                    <p>Every time a user you referred purchases currency, you will get 10% of the amount they purchased for free!</p>
                    <p>You can find your invite link below.</p>
                    <input class="form-control" style="cursor:pointer;" type="text" name="invite_link" placeholder="Invite Link" value="<?php echo e(config('site.referral_url')); ?>/<?php echo e(Auth::user()->referral_code); ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <h3>Invited Users</h3>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 col-md-3">
                                <a href="<?php echo e(route('users.profile', $user->username)); ?>">
                                    <img src="<?php echo e($user->thumbnail()); ?>">
                                </a>
                            </div>
                            <div class="col-8 col-md-9">
                                <div class="text-truncate">
                                    <a href="<?php echo e(route('users.profile', $user->username)); ?>" style="color:inherit;text-decoration:none;font-size:21px;"><?php echo e($user->username); ?></a>
                                    <hr style="margin-top:10px;margin-bottom:10px;">
                                    <strong>Date:</strong>
                                    <span><?php echo e($user->created_at->format('M d, Y')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>You haven't invited any users yet.</p>
            <?php endif; ?>
            <?php echo e($users->onEachSide(1)); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Invite'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/invite.blade.php ENDPATH**/ ?>