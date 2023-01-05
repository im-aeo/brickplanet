<?php $__env->startSection('meta'); ?>
    <meta name="item-types-with-padding" content="<?php echo e(json_encode(config('site.item_thumbnails_with_padding'))); ?>">
    <meta name="item-type-padding-amount" content="<?php echo e(itemTypePadding('default')); ?>">
    <meta name="user-info" data-id="<?php echo e($user->id); ?>" data-inventory-public="<?php echo e($user->setting->public_inventory); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/profile.js?v=4')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        img.headshot {
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        @media only screen and (min-width: 768px) {
            img.headshot {
                width: 60px;
            }
        }

        .user {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .user:not(:last-child) {
            border-bottom: 1px solid var(--divider_color);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="grid-x grid-margin-x align-middle">
		<div class="auto cell no-margin">
			<h4><?php echo e($user->username); ?>'s Backpack</h4>
		</div>
      <div class="shrink cell right no-margin">
        
      </div>
</div>
<div class="push-10"></div>
<div class="container border-r md-padding">
	<div class="grid-x grid-margin-x">
			<div class="large-2 cell no-margin">
                            <ul class="user-backpack-side-menu" role="tablist">
                              <?php $__currentLoopData = config('site.inventory_item_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php if($type == 'hat'): ?> active <?php endif; ?>" data-category="<?php echo e(lcfirst(itemType($type, true))); ?>"><?php echo e(itemType($type, true)); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="large-10 cell no-margin">
                          
                            <div class="grid-x grid-margin-x clearfix" id="inventory"></div>
                          </div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', [
    'title' => "$user->username's Backpack"
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/users/items.blade.php ENDPATH**/ ?>