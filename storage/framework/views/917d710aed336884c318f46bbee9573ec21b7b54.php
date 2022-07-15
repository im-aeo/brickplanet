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
        img.user-headshot {
            background: var(--section_bg);
            border-radius: 6px;
            width: 50px;
        }

        .primary-group {
            background: var(--section_bg_inside);
            font-weight: 600;
            border-radius: 4px;
            padding: 3px 10px;
        }

        .primary-group a {
            color: inherit;
            font-size: 12px;
        }

        .primary-group .rank {
            font-size: 11px;
            margin-top: -2px;
            margin-bottom: 5px;
        }

        .primary-group img {
            border-radius: 6px;
            max-width: 250%;
        }

        @media  only screen and (max-width: 768px) {
            .primary-group img {
                max-width: 35%;
                margin-top: 5px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($thread->is_deleted): ?>
        <div class="alert bg-danger text-white text-center">This thread is deleted.</div>
    <?php endif; ?>
    <div class="grid-x grid-margin-x forum-top-links">
		<div class="large-10 large-offset-1 cell">
          
        <a href="<?php echo e(route('forum.index')); ?>">Forum</a>
          	&nbsp;&raquo;&nbsp;
        <a href="<?php echo e(route('forum.topic', [$thread->topic->id, $thread->topic->slug()])); ?>"><?php echo e($thread->topic->name); ?></a>
          &nbsp;&raquo;&nbsp;
        <?php echo e($thread->title); ?>

    </div>
</div>
    <div class="grid-x grid-margin-x">
			<div class="large-10 large-offset-1 cell">
				<div class="container md-padding border-r" style="word-break:break-word;">
				<div class="grid-x grid-margin-x align-middle forum-thread-title">
					<div class="auto cell no-margin">
                      
                <?php if($thread->is_pinned): ?> <i class="material-icons">pin</i> <?php endif; ?>
                <?php if($thread->is_locked): ?> <i class="material-icons">lock</i> <?php endif; ?>
                <span class="title"><?php echo e($thread->title); ?></span>
            </div>
<div class="shrink cell right no-margin">
  <?php if(!Auth::check() || (Auth::check() && (!$thread->is_locked || Auth::user()->isStaff() && $thread->is_locked))): ?>
                <a href="<?php echo e(route('forum.new', ['reply', $thread->id])); ?>" class="button button-green"><i class="material-icons">reply</i><span>Reply</span></a>
            <?php else: ?>
                
            <?php endif; ?>
                  </div>
                  </div>
            <?php if($thread->replies()->currentPage() == 1): ?>
                <div class="forum-thread-header">
					<div class="grid-x grid-margin-x align-middle">
						<div class="thread-header-adjustment large-shrink medium-shrink small-4 cell">
                          <div class="user-<?php echo e(($thread->creator->online()) ? 'online' : 'offline'); ?>"></div>
                                    <a href="<?php echo e(route('users.profile', $thread->creator->username)); ?>" style="color:inherit;"><?php echo e($thread->creator->username); ?></a>
                                    <?php if($thread->creator->is_verified): ?>
                                        <i class="fas fa-shield-check text-success ml-1" style="font-size:13px;" title="This user is verified." data-toggle="tooltip"></i>
                                    <?php endif; ?>
                      </div>
                      <div class="auto cell">
							<span class="show-for-medium">Posted </span><span>
                        <?php echo e($thread->created_at->diffForHumans()); ?>

                        </span>
                      </div>
                      <div class="shrink cell right">
                        <?php if(auth()->guard()->check()): ?>
                                    <?php if(!$thread->is_locked || (Auth::user()->isStaff() && $thread->is_locked)): ?>
                                        <a href="<?php echo e(route('forum.new', ['quote', $thread->id])); ?>" class="quote-a"><i class="material-icons">format_quote</i></a>
                                    <?php endif; ?>

                                    <?php if($thread->creator->id != Auth::user()->id && !$thread->creator->isStaff()): ?>
                                        <a href="<?php echo e(route('report.index', ['forum-thread', $thread->id])); ?>" class="report-abuse-forum-icon"><i class="material-icons" class="report-abuse-forum-icon">flag</i></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                        
                        <?php if(Auth::check() && Auth::user()->isStaff()): ?>
                                    <?php if(
                                        Auth::user()->staff('can_delete_forum_posts') ||
                                        Auth::user()->staff('can_edit_forum_posts') ||
                                        Auth::user()->staff('can_pin_forum_posts') ||
                                        Auth::user()->staff('can_lock_forum_posts')
                                    ): ?> <?php echo (!$thread->creator->forum_signature) ? '' : ''; ?>  <?php endif; ?>

                                    <?php if(Auth::user()->staff('can_delete_forum_posts')): ?>
                                        <a href="<?php echo e(route('forum.moderate', ['thread', 'delete', $thread->id])); ?>" class="quote-a"><i class="material-icons">delete</i></a>
                                    <?php endif; ?>

                                    <?php if(Auth::user()->staff('can_edit_forum_posts')): ?>
                                        <a href="<?php echo e(route('forum.edit', ['thread', $thread->id])); ?>" class="quote-a"><i class="material-icons">border_color</i></a>
                                    <?php endif; ?>

                                    <?php if(Auth::user()->staff('can_pin_forum_posts')): ?>
                                        <a href="<?php echo e(route('forum.moderate', ['thread', 'pin', $thread->id])); ?>" class="quote-a"><i class="material-icons">pin_drop</i></a>
                                    <?php endif; ?>

                                    <?php if(Auth::user()->staff('can_lock_forum_posts')): ?>
                                        <a href="<?php echo e(route('forum.moderate', ['thread', 'lock', $thread->id])); ?>" class="quote-a"><i class="material-icons">lock</i></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                        
  
                            </div>
                        </div>
                    </div>
                    <div class="forum-content-wrapper">
					<div class="grid-x grid-margin-x">
						<div class="large-shrink medium-shrink small-4 cell text-center">
                                <a href="<?php echo e(route('users.profile', $thread->creator->username)); ?>">
                                    <img width="175" height="175" src="<?php echo e($thread->creator->thumbnail()); ?>">
                                </a>

                                

                                <?php if($thread->creator->hasPrimaryGroup()): ?>
                                    <div class="forum-user-favorite-group">
									<div class="grid-x grid-margin-x align-middle">
                                      
										<div class="shrink cell no-margin">
                                          
                                                <a href="<?php echo e(route('groups.view', [$thread->creator->primaryGroup->id, $thread->creator->primaryGroup->slug()])); ?>">
                                                  
                                                    <div class="forum-user-favorite-group-logo"  style="background:url('<?php echo e($thread->creator->primaryGroup->thumbnail()); ?>');background-size:cover;"></div></a>
                                      </div>
                                            <div class="auto cell no-margin forum-user-favorite-group-name">
                                                    <a href="<?php echo e(route('groups.view', [$thread->creator->primaryGroup->id, $thread->creator->primaryGroup->slug()])); ?>"><?php echo e($thread->creator->primaryGroup->name); ?></a>
                                              </div>
                                        </div>
                                    </div>
                                              <?php endif; ?>
                                                    
                                            
                          
                                <?php if($thread->creator->isStaff()): ?>
                                    <div class="forum-admin">
									<i class="fa fa-gavel show-for-medium"></i><span>Admin</span><span class="show-for-medium">istrator</span>
								</div>
                                <?php elseif($thread->creator->hasMembership()): ?>
                                    <div class="card-planet-constructor" style="color:<?php echo e(config('site.membership_color')); ?>;background:<?php echo e(config('site.membership_bg_color')); ?>;"><div class="card-image"><span><?php echo e(config('site.membership_name')); ?></span></div>
                                <?php endif; ?>
<div class="thread-user-stats show-for-medium">
								<div class="stat-left">Join Date:</div>
								<div class="stat-right"><?php echo e($thread->creator->created_at->format('d/m/Y')); ?></div>
							</div>
                          <div class="thread-user-stats">
								<div class="stat-left">Posts:</div>
                            
                                    <div class="stat-right"><?php echo e(number_format($thread->creator->forumPostCount())); ?></div>
							</div>
                                <div class="thread-user-stats">
								<div class="stat-left">Level:</div>
                                   
                                    <div class="stat-right"><?php echo e($thread->creator->forum_level); ?></div>
							</div>
						</div>
						<div class="large-auto medium-auto small-8 cell">
							<div class="forum-main-content">
								<div class="forum-thread-body">
                                <div><?php echo nl2br(e($thread->body)); ?></div>
                                  <?php if($thread->creator->forum_signature): ?>
                                    <div class="group-divider"></div>
                                    <div><?php echo e($thread->creator->forum_signature); ?></div>
                                <?php endif; ?>
                                  
                              </div>
                          </div>

                               

                                
                            </div>
                        </div>
                    </div>
                
            <?php endif; ?>

            <?php $__currentLoopData = $thread->replies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="forum-thread-header">
					<div class="grid-x grid-margin-x align-middle">
						<div class="thread-header-adjustment large-shrink medium-shrink small-4 cell">
                          <div class="user-<?php echo e(($reply->creator->online()) ? 'online' : 'offline'); ?>"></div>
                                    <a href="<?php echo e(route('users.profile', $reply->creator->username)); ?>" style="color:inherit;"><?php echo e($reply->creator->username); ?></a>
                                    <?php if($reply->creator->is_verified): ?>
                                        <i class="fas fa-shield-check text-success ml-1" style="font-size:13px;" title="This user is verified." data-toggle="tooltip"></i>
                                    <?php endif; ?>
                      </div>
                      <div class="auto cell">
							<span class="show-for-medium">Posted </span><span>
                        <?php echo e($reply->created_at->diffForHumans()); ?>

                        </span>
                      </div>
                      <div class="shrink cell right">
                        <?php if(auth()->guard()->check()): ?>
                                    

                                    <?php if($reply->creator->id != Auth::user()->id && !$reply->creator->isStaff()): ?>
                                        <a href="<?php echo e(route('report.index', ['forum-reply', $reply->id])); ?>" class="report-abuse-forum-icon"><i class="material-icons" class="report-abuse-forum-icon">flag</i></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                        
                        <?php if(Auth::check() && Auth::user()->isStaff()): ?>
                                    <?php if(
                                        Auth::user()->staff('can_delete_forum_posts') ||
                                        Auth::user()->staff('can_edit_forum_posts') ||
                                        Auth::user()->staff('can_pin_forum_posts') ||
                                        Auth::user()->staff('can_lock_forum_posts')
                                    ): ?> <?php echo (!$reply->creator->forum_signature) ? '' : ''; ?>  <?php endif; ?>

                                    

                                    <?php if(Auth::user()->staff('can_edit_forum_posts')): ?>
                                        <a href="<?php echo e(route('forum.edit', ['reply', $reply->id])); ?>" class="quote-a"><i class="material-icons">border_color</i></a>
                                    <?php endif; ?>

                                    
                                <?php endif; ?>
                        
  
                            </div>
                        </div>
                    </div>
                    <div class="forum-content-wrapper">
					<div class="grid-x grid-margin-x">
						<div class="large-shrink medium-shrink small-4 cell text-center">
                                <a href="<?php echo e(route('users.profile', $reply->creator->username)); ?>">
                                    <img width="175" height="175" src="<?php echo e($reply->creator->thumbnail()); ?>">
                                </a>

                                

                                <?php if($reply->creator->hasPrimaryGroup()): ?>
                                    <div class="forum-user-favorite-group">
									<div class="grid-x grid-margin-x align-middle">
                                      
										<div class="shrink cell no-margin">
                                          
                                                <a href="<?php echo e(route('groups.view', [$reply->creator->primaryGroup->id, $reply->creator->primaryGroup->slug()])); ?>">
                                                  
                                                    <div class="forum-user-favorite-group-logo"  style="background:url('<?php echo e($reply->creator->primaryGroup->thumbnail()); ?>');background-size:cover;"></div></a>
                                      </div>
                                            <div class="auto cell no-margin forum-user-favorite-group-name">
                                                    <a href="<?php echo e(route('groups.view', [$reply->creator->primaryGroup->id, $reply->creator->primaryGroup->slug()])); ?>"><?php echo e($reply->creator->primaryGroup->name); ?></a>
                                              </div>
                                        </div>
                                    </div>
                                              <?php endif; ?>
                                                    
                                            
                          
                                <?php if($reply->creator->isStaff()): ?>
                                    <div class="forum-admin">
									<i class="fa fa-gavel show-for-medium"></i><span>Admin</span><span class="show-for-medium">istrator</span>
								</div>
                                <?php elseif($reply->creator->hasMembership()): ?>
                                    <div class="card-planet-constructor" style="color:<?php echo e(config('site.membership_color')); ?>;background:<?php echo e(config('site.membership_bg_color')); ?>;"><div class="card-image"><span><?php echo e(config('site.membership_name')); ?></span></div>
                                <?php endif; ?>
<div class="thread-user-stats show-for-medium">
								<div class="stat-left">Join Date:</div>
								<div class="stat-right"><?php echo e($reply->creator->created_at->format('d/m/Y')); ?></div>
							</div>
                          <div class="thread-user-stats">
								<div class="stat-left">Posts:</div>
                            
                                    <div class="stat-right"><?php echo e(number_format($reply->creator->forumPostCount())); ?></div>
							</div>
                                <div class="thread-user-stats">
								<div class="stat-left">Level:</div>
                                   
                                    <div class="stat-right"><?php echo e($reply->creator->forum_level); ?></div>
							</div>
						</div>
						<div class="large-auto medium-auto small-8 cell">
							<div class="forum-main-content">
								<div class="forum-thread-body">
                                <div><?php echo nl2br(e($reply->body)); ?></div>
                                  <?php if($reply->creator->forum_signature): ?>
                                    <div class="group-divider"></div>
                                    <div><?php echo e($reply->creator->forum_signature); ?></div>
                                <?php endif; ?>
                                  
                              </div>
                          </div>

                               

                                
                            </div>
                        </div>
                    </div>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
              </div>
        </div>
    </div>
</div>
    <?php echo e($thread->replies()->onEachSide(1)->links('vendor.pagination.aeo')); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => $thread->title,
    'image' => $thread->creator->headshot()
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/forum/thread.blade.php ENDPATH**/ ?>