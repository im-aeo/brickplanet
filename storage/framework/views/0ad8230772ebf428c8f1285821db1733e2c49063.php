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
	<div class="grid-x grid-margin-x align-middle">
		<div class="auto cell no-margin">
			<h4 style="margin:0;"><strong><?php echo e($user->username); ?></strong> is a member of <?php echo e($groups->count()); ?> <?php if($groups->count() != 1): ?> groups <?php else: ?> group <?php endif; ?></h4>
		</div>
		<div class="shrink cell right no-margin">
			<a href="<?php echo e(route('users.profile', $user->username)); ?>" class="button button-grey" style="padding: 8px 15px;font-size:13px;line-height:1.25;">Return to Profile</a>
		</div>
	</div>
	<div class="push-10"></div>
	<div class="container border-r md-padding">
      
<?php $__empty_1 = true; $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>      
<div class="grid-x grid-margin-x group-table">
					<div class="large-2 medium-3 small-4 cell center-text">
						<a href="<?php echo e(route('groups.view', [$group->id, $group->slug()])); ?>" class="gt-link"><img src="<?php echo e($group->thumbnail()); ?>"></a>
						<div class="grid-x grid-margin-x align-middle gt-info">
							<div class="large-6 medium-6 small-6 cell">
								<strong>Owner:</strong>
							</div>
							<div class="large-6 medium-6 small-6 cell text-right">
								<a href="<?php echo e(route('users.profile', $group->owner->username)); ?>"><?php echo e($group->owner->username); ?></a>
							</div>
							<div class="large-6 medium-6 small-6 cell">
								<strong>Members:</strong>
							</div>
							<div class="large-6 medium-6 small-6 cell text-right">
								<?php echo e(shortNum($group->member_count)); ?> 
							</div>
						</div>
					</div>
					<div class="large-10 medium-9 small-8 cell">
						<div class="gt-title"><a href="<?php echo e(route('groups.view', [$group->id, $group->slug()])); ?>"><span><?php echo e($group->name); ?></span> <?php if($group->is_verified == 1): ?> 
                          <i class="material-icons" style="color:#00ACEE;" title="This group is verified">
                        verified
                        </i>
                     <?php endif; ?></a></div>
						<div class="gt-description"><?php echo (!empty($group->description)) ? nl2br(e($group->description)) : 'This group does not have an description.'; ?></div>
					</div>
				</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="grid-x grid-margin-x">
				<div class="auto cell">
					This user is not a member of any groups.
				</div>
			</div>      
<?php endif; ?>    
 
</div>
<div class="push-25"></div>
<?php echo e($groups->onEachSide(1)); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => "{$user->username}'s Groups"
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/users/groups.blade.php ENDPATH**/ ?>