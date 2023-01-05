<?php $__env->startSection('content'); ?>
<div class="home-teaser"></div>
	<div class="grid-container">
		<div class="home-content-white">
			<div class="home-big-title-text text-center">We innovate</div>
			<div class="home-text text-center">At <?php echo e(config('site.name')); ?>, we prioritize two things &dash; customer satisfaction and innovation. And we know that is only possible by having great people behind the scenes.</div>
			<div class="home-button-learnmore"><a href="<?php echo e(route('jobs.listings.index')); ?>">Search Openings</a></div>
		</div>
		<div class="home-content-grey">
			<div class="home-big-title-text">A growing startup</div>
			<div class="home-text">We're headquartered in Huntsville, Alabama, America's fastest growing tech city. <?php echo e(config('site.name')); ?> was founded by young adults with a common goal of creating the best gaming platform where players can create and share their creations with the world.<br/>We embrace diversity, inclusion, and new ideas.</div>
		</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.jobs', [
    'title' => 'About Us'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/jobs/about.blade.php ENDPATH**/ ?>