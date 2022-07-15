<?php $__env->startSection('meta'); ?>
    <meta name="item-types-with-padding" content="<?php echo e(json_encode(config('site.item_thumbnails_with_padding'))); ?>">
    <meta name="item-type-padding-amount" content="<?php echo e(itemTypePadding('default')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/catalog.js?v=9')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="store-topbar">
		<div class="grid-x align-middle grid-margin-x">
			<div class="auto cell no-margin">
				<ul>
                  <?php $__currentLoopData = config('site.catalog_item_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li id="<?php echo e(lcfirst(itemType($type, true))); ?>" class="<?php if($type == 'hat'): ?> active <?php endif; ?>" data-category="<?php echo e(lcfirst(itemType($type, true))); ?>"><?php echo e(itemType($type, true)); ?>

                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
					
				</ul>
			</div>
		</div>
	</div>
<div class="container border-wh">
  
<div class="grid-x grid-margin-x" id="items-div"></div>
  </div><div class="push-25"></div></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Store - Buy Items!'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/catalog/index.blade.php ENDPATH**/ ?>