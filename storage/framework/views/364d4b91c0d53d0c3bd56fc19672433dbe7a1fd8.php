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
		<div class="auto cell no-margin">
			<h4>Groups</h4>
		</div>
<div class="shrink cell right no-margin">
<a href="<?php echo e(route('creator_area.index', ['t' => 'group'])); ?>" class="button button-green">Create</a>
</div>
</div>
	<div class="push-15"></div>
	<div class="container md-padding border-r">
      <?php $__empty_1 = true; $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="grid-x grid-margin-x group-table">
					<div class="large-2 medium-3 small-4 cell center-text">
                        <a href="<?php echo e(route('groups.view', [$group->id, $group->slug()])); ?>" class="gt-link">
                                <img src="<?php echo e($group->thumbnail()); ?>">
                      </a>
                      
                      <div class="clearfix gt-info">
							<div class="left">
								<strong>Owner:</strong>
							</div>
							<div class="right">
                        <a href="<?php echo e(route('groups.view', [$group->id, $group->slug()])); ?>"><?php echo e($group->owner->username); ?></a>
                      
                      
        </div>
      </div>
                      <div class="clearfix gt-info">
							<div class="left">
								<strong>Members:</strong>
							</div>
							<div class="right">
                           <a href="<?php echo e(route('groups.view', [$group->id, $group->slug()])); ?>"><?php echo e($group->member_count); ?></a>   
                        </div>
                      </div>
        </div>
					<div class="large-10 medium-9 small-8 cell">
						<div class="gt-title">
        
                                        <a href="<?php echo e(route('groups.view', [$group->id, $group->slug()])); ?>"><span><?php echo e($group->name); ?></span>
                          
                                          </a>
                      </div>
                                    
                                    <div class="gt-description"><?php echo e($group->description ?? 'This group does not have a description.'); ?></div>
                                </div>
                            </div>

  
<div class="group-divider"></div>                 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="grid-x grid-margin-x"><div class="auto cell">No results found. Try refining your search.</div></div>
                    <?php endif; ?>
                    <div class="pages"><?php echo e($groups->onEachSide(1)); ?></div>
   
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', [
    'title' => 'Groups'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/groups/index.blade.php ENDPATH**/ ?>