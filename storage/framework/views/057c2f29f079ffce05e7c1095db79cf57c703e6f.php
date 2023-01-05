<?php $__env->startSection('css'); ?>
    <style>
        .listing:not(:first-child) {
            padding-top: 16px;
        }

        .listing:not(:last-child) {
            padding-bottom: 16px;
            border-bottom: 1px solid #0000001a;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
		<div class="grid-container"><div class="site-header-margin"></div>
		<div class="job-container">
		<div class="page-title">Job Openings</div>
          <div class="job-content">
       <?php $__empty_1 = true; $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="job-pos">
				<div class="grid-x grid-margin-x align-middle">
					<div class="large-8 cell">
						<div class="job-pos-title"><?php echo e($listing->title); ?></div>
						<div class="job-pos-category"><?php echo e($listing->category); ?></div>
						<div class="grid-x grid-margin-x">
							<div class="shrink cell no-margin">
								<div class="ico-group">
									<i class="material-icons">home</i>
									<span>Remote</span>
								</div>
							</div>
                          <div class="shrink cell no-margin">
									<div class="ico-group">
										<i class="material-icons">assignment</i>
										<span>Contract Based</span>
									</div>
								</div>
						</div>
					</div>
					<div class="large-4 cell text-right">
						<a href="<?php echo e(route('jobs.listings.view', $listing->uid)); ?>" class="job-learnmore" title="View Listing">View</a>
					</div>
				</div>
			</div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>There are currently no available listings. Check again later!</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo e($listings->onEachSide(1)); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.jobs', [
    'title' => 'Listings'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/jobs/listings/index.blade.php ENDPATH**/ ?>