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
    <div class="row mb-2">
        <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"><strong>Reporter:</strong></div>
                            <div class="col-md-9"><a href="<?php echo e(route('users.profile', $report->reporter->username)); ?>" target="_blank"><?php echo e($report->reporter->username); ?></a></div>
                            <div class="col-md-3"><strong>Type:</strong></div>
                            <div class="col-md-9">
                                <span><?php echo e($report->type()); ?></span>
                                <?php if($report->url()): ?>
                                    <a href="<?php echo e($report->url()); ?>" target="_blank">[Click to view]</a>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3"><strong>Category:</strong></div>
                            <div class="col-md-9"><?php echo e($report->category); ?></div>
                            <div class="col-md-12">
                                <div class="mb-2 hide-sm"></div>
                                <strong>Comment:</strong>
                                <div><?php echo (!empty($report->comment)) ? nl2br(e($report->comment)) : '<div class="text-muted">This report does not have a comment.</div>'; ?></div>
                            </div>
                            <?php if(!$report->url()): ?>
                                <div class="col-md-12">
                                    <div class="mb-2 hide-sm"></div>
                                    <strong>Content:</strong>
                                    <div><?php echo e($report->content->body); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <form action="<?php echo e(route('admin.reports.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($report->id); ?>">
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-block btn-success" type="submit"><i class="fas fa-eye"></i></button>
                                </div>
                                <?php if(staffUser()->staff('can_ban_users')): ?>
                                    <div class="col">
                                        <a href="<?php echo e(route('admin.users.ban.index', $report->reported_user_id)); ?>" class="btn btn-block btn-danger" target="_blank"><i class="fas fa-gavel"></i></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col">There are currently no pending reports.</div>
        <?php endif; ?>
    </div>
    <?php echo e($reports->onEachSide(1)); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
    'title' => 'Reports'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/reports.blade.php ENDPATH**/ ?>