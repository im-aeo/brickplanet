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
            margin-top: -2px;
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
<?php if($topic->threads()->count() == 0): ?>
                <span>There are currently no forum topics. <a href="<?php echo e(route('forum.new', ['thread', $topic->id])); ?>">Create one?</a></span>
            <?php else: ?>
    <div class="grid-x grid-margin-x forum-top-links">
		<div class="auto cell">
			<a href="<?php echo e(route('forum.index')); ?>">Forum</a>
			&nbsp;&raquo;&nbsp;
			<?php echo e($topic->name); ?>

		</div>
	</div>
<div class="grid-x grid-margin-x">
		<div class="<?php if(auth()->guard()->check()): ?> large-9 <?php else: ?> auto <?php endif; ?> cell">
			<div class="container-header strong forum-header">
				<div class="grid-x grid-margin-x align-middle">
					<div class="large-7 medium-8 small-8 cell">
						<?php echo e($topic->name); ?>

					</div>
					<div class="large-1 medium-2 small-2 cell text-center">
						Replies
					</div>
					<div class="large-1 medium-2 small-2 cell text-center">
						Views
					</div>
					<div class="large-3 cell text-right show-for-large">
						Last Post
					</div>
				</div>
			</div>
			<div class="container border-wh">
<?php $__currentLoopData = $topic->threads(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					
					<div class="topic-divider"></div>
					
					
					
					<div class="grid-x grid-margin-x align-middle forum-topic-container">
						<div class="large-7 medium-8 small-8 cell">
							<div class="grid-x grid-margin-x align-middle">
								<div class="shrink cell no-margin show-for-medium">
									<div style="border-radius:50%;width:48px;height:48px;background-image:url(<?php echo e($thread->creator->headshot()); ?>);background-color:#1D1F24;background-size:cover;overflow:hidden;"></div>
								</div>
								<div class="auto cell topic-post-info">
									<div class="thread-content-title"><a href="<?php echo e(route('forum.thread', $thread->id)); ?>"><?php echo e($thread->title); ?></a>
									
									</div>
									<div class="grid-x grid-margin-x align-middle">
										<div class="shrink cell no-margin">
										<?php if($thread->is_pinned): ?>
											
											<span class="thread-pinned"><i class="material-icons" style="font-size:11px;">gavel</i> Pinned</span>
											
										<?php elseif($thread->is_pinned): ?>
											
											<span class="thread-locked"><i class="material-icons" style="font-size:11px;">lock</i> Locked</span>
											
									<?php endif; ?>
										
										</div>
										<div class="large-auto medium-auto small-12 cell no-margin">
											<div class="thread-content-post"><span class="show-for-medium">Posted by</span> <span><a  href="<?php echo e(route('users.profile', $thread->creator->username)); ?>" <?php if($thread->creator->isStaff()): ?> style="color:#ec2b1d;" <?php endif; ?>><strong><?php echo e($thread->creator->username); ?></strong></a>&nbsp;-&nbsp;<?php echo e($thread->updated_at->diffForHumans()); ?></span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="large-1 medium-2 small-2 cell text-center">
							<?php echo e(number_format($thread->replies(false)->count())); ?>

						</div>
						<div class="large-1 medium-2 small-2 cell text-center">
							<?php echo e(number_format($thread->views)); ?>

						</div>
						<div class="large-3 cell text-right show-for-large" style="word-break:break-word;">
                           <?php if($thread->lastReply()): ?>
                          
							<a href="'.$serverName.'/forum/thread/'.$getT->ID.'/'; if ($getT->LastPostReplyID != 0) { echo '#'.$getT->LastPostReplyID.''; } echo '" class="last-post-link"><?php echo e($thread->title); ?></a>
							<div class="last-post-link">by <a href="<?php echo e(route('users.profile', $thread->lastReply()->creator->username)); ?>" <?php if($thread->creator->isStaff()): ?> style="color:#ec2b1d;" <?php endif; ?>><strong><?php echo e($thread->lastReply()->creator->username); ?></strong></a>&nbsp;- <?php echo e($thread->lastReply()->updated_at->diffForHumans()); ?></div>
                          <?php else: ?>
                          
                          N/A
                          
                          <?php endif; ?>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			</div>
 <?php echo e($topic->threads()->onEachSide(1)->links('vendor.pagination.aeo')); ?>

		
		<?php if(auth()->guard()->check()): ?>
<?php echo $__env->make('web.forum._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php else: ?>
</div></div>
<?php endif; ?>
          
          <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', [
    'title' => $topic->name
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/forum/topic.blade.php ENDPATH**/ ?>