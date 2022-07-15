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
        .thread {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .thread:not(:last-child) {
            border-bottom: 1px solid var(--divider_color);
        }

        .thread:hover {
            background: var(--section_bg_hover);
        }

        .thread .user-headshot {
            width: 50px;
            height: 50px;
            float: left;
            position: relative;
            overflow: hidden;
        }

        .thread .user-headshot img {
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        .thread .details {
            padding-left: 25px;
        }

        .thread .status {
            font-size: 11px;
            border-radius: 4px;
            margin-right: 5px;
            padding: 0.5px 5px;
            font-weight: 600;
            display: inline-block;
        }

        .thread .status i {
            font-size: 10px;
            vertical-align: middle;
        }

        .thread .status i.fa-lock {
            margin-top: -1px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h3>Forum</h3>
    <ul class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="<?php echo e(route('forum.index')); ?>">Forum</a></li>
        <li class="breadcrumb-item active">Search</li>
    </ul>
    <form action="<?php echo e(route('forum.search')); ?>" method="GET">
        <input class="form-control mb-3" type="text" name="search" placeholder="Search..." value="<?php echo e(request()->search); ?>">
    </form>
    <?php if(!empty($search)): ?>
        <?php if($threads->count() == 0): ?>
            <p>No threads have been found.</p>
        <?php else: ?>
            <div class="card">
                <div class="card-header bg-primary text-white" style="padding-left:15px;padding-right:15px;">
                    <div class="row">
                        <div class="col-md-8">Post</div>
                        <div class="col-md-2 text-center hide-sm">Replies</div>
                        <div class="col-md-2 text-center hide-sm">Last Reply</div>
                    </div>
                </div>
                <div class="card-body" style="padding-top:0;padding-left:15px;padding-right:15px;padding-bottom:0;">
                    <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row thread">
                            <div class="col-md-8">
                                <div class="user-headshot">
                                    <img src="<?php echo e($thread->creator->headshot()); ?>" width="150px">
                                </div>
                                <div class="details text-truncate">
                                    <a href="<?php echo e(route('forum.thread', $thread->id)); ?>" style="color:inherit;font-size:18px;font-weight:600;text-decoration:none;"><?php echo e($thread->title); ?></a>
                                    <div class="text-muted" style="margin-top:-3px;">
                                        <?php if($thread->is_pinned): ?>
                                            <span class="status bg-danger text-white"><i class="fas fa-thumbtack mr-1"></i> Pinned</span>
                                        <?php elseif($thread->is_locked): ?>
                                            <span class="status text-white" style="background:#000;"><i class="fas fa-lock mr-1"></i> Locked</span>
                                        <?php endif; ?>

                                        <span class="hide-sm">Posted by</span>
                                        <a href="<?php echo e(route('users.profile', $thread->creator->username)); ?>" <?php if($thread->creator->isStaff()): ?> class="text-danger" <?php endif; ?>><?php echo e($thread->creator->username); ?></a>
                                        <span>- <?php echo e($thread->created_at->diffForHumans()); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 text-center align-self-center hide-sm"><?php echo e(number_format($thread->replies(false)->count())); ?></div>
                            <div class="col-md-2 text-center align-self-center hide-sm">
                                <?php if($thread->lastReply()): ?>
                                    <a href="<?php echo e(route('users.profile', $thread->lastReply()->creator->username)); ?>" <?php if($thread->lastReply()->creator->isStaff()): ?> class="text-danger" <?php endif; ?>><?php echo e($thread->lastReply()->creator->username); ?></a>
                                    <div><?php echo e($thread->lastReply()->created_at->diffForHumans()); ?></div>
                                <?php else: ?>
                                    <a href="<?php echo e(route('users.profile', $thread->creator->username)); ?>" <?php if($thread->creator->isStaff()): ?> class="text-danger" <?php endif; ?>><?php echo e($thread->creator->username); ?></a>
                                    <div><?php echo e($thread->created_at->diffForHumans()); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php echo e($threads->onEachSide(1)); ?>

        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Search'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/forum/search.blade.php ENDPATH**/ ?>