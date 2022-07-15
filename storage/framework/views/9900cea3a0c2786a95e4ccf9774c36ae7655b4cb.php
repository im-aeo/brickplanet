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
    <meta name="group-info" data-id="<?php echo e($group->id); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/group_manage.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h3>Manage "<?php echo e($group->name); ?>"</h3>
    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('groups.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($group->id); ?>">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Logo</label><br>
                        <img class="mb-2" style="background:var(--section_bg_inside);border-radius:6px;" src="<?php echo e($group->thumbnail()); ?>">
                        <?php if(!$group->is_thumbnail_pending): ?>
                            <input name="logo" type="file">
                        <?php endif; ?>
                        <div class="mb-2 show-sm-only"></div>
                    </div>
                    <div class="col-md-9">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" placeholder="Description" rows="10"><?php echo e($group->description); ?></textarea>
                    </div>
                </div>
                <button class="btn btn-block btn-success" type="submit">Update</button>
            </form>
        </div>
    </div>
    <h3>Ranks</h3>
    <div class="card">
        <div class="card-body">Coming soon.</div>
    </div>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <span href="#membersTab" class="nav-link active" data-toggle="tab">Members</span>
                </li>
                <?php if($group->is_private): ?>
                    <li class="nav-item">
                        <span href="#joinRequestsTab" class="nav-link" data-toggle="tab">Join Requests</span>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <span href="#vaultTab" class="nav-link" data-toggle="tab">Vault</span>
                </li>
                <li class="nav-item">
                    <span href="#settingsTab" class="nav-link" data-toggle="tab">Settings</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active show" id="membersTab">
            <div class="row">
                <div class="col">
                    <h3>Members</h3>
                </div>
                <div class="col text-right">
                    <select class="form-control">
                        <?php $__currentLoopData = $group->ranks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rank->rank); ?>"><?php echo e($rank->name); ?> (<?php echo e($rank->memberCount()); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row" id="members"></div>
                </div>
            </div>
        </div>
        <?php if($group->is_private): ?>
            <div class="tab-pane" id="joinRequestsTab">
                <h3>Join Requests (<?php echo e(number_format($joinRequests->count())); ?>)</h3>
                <div class="card" <?php if($joinRequests->count() > 0): ?> style="padding-bottom:0;" <?php endif; ?>>
                    <div class="card-body">
                        <div class="row">
                            <?php $__empty_1 = true; $__currentLoopData = $joinRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $joinRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-6 col-md-2 text-center">
                                    <div class="card" style="border:none;">
                                        <a href="<?php echo e(route('users.profile', $joinRequest->user->username)); ?>">
                                            <img src="<?php echo e($joinRequest->user->thumbnail()); ?>">
                                            <div class="text-truncate mt-1"><?php echo e($joinRequest->user->username); ?></div>
                                        </a>
                                        <form action="<?php echo e(route('groups.update_join_request')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($joinRequest->id); ?>">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <button class="btn btn-block btn-success" name="action" value="accept"><i class="fas fa-check"></i></button>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-block btn-danger" name="action" value="decline"><i class="fas fa-times"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col">There currently are no pending join requests.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="tab-pane" id="vaultTab">
            <h3>Vault</h3>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <h1 class="text-center">
                                <i class="currency" style="background-size:30px 30px;width:30px;height:30px;"></i>
                                <span id="vaultAmount"><?php echo e(number_format($group->vault)); ?></span>
                            </h1>
                            <form id="payout">
                                <label for="username">Receiver Username</label>
                                <input class="form-control mb-2" type="text" name="username" placeholder="Receiver Username">
                                <label for="amount">Payout Amount</label>
                                <input class="form-control mb-3" type="number" name="amount" placeholder="Payout Amount" min="1">
                                <p class="text-danger" id="payoutError"></p>
                                <button class="btn btn-block btn-success">Payout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="settingsTab">
            <h3>Settings</h3>
            <form action="<?php echo e(route('groups.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($group->id); ?>">
                <input type="hidden" name="from_settings_tab" value="true">
                <div class="card">
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_private" <?php if($group->is_private): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="is_private">Request to join</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_vault_viewable" <?php if($group->is_vault_viewable): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="is_vault_viewable">Is vault viewable</label>
                        </div>
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </div>
                <h3>Ownership</h3>
                <div class="card">
                    <div class="card-body">
                        <p>Coming soon.</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => "Manage \"$group->name\""
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/groups/manage.blade.php ENDPATH**/ ?>