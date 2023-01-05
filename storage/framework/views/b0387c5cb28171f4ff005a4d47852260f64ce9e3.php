<?php $__env->startSection('meta'); ?>
    <meta name="item-types-with-padding" content="<?php echo e(json_encode(config('site.item_thumbnails_with_padding'))); ?>">
    <meta name="item-type-padding-amount" content="<?php echo e(itemTypePadding('default')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
  .text-md-padding {
    padding: 15px;
    font-size: 15px;
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="error-message">
			<span><i class="material-icons" style="vertical-align:middle;margin-right:5px;font-size:20px;">report_problem</i></span><span><strong>Oops!</strong> Store purchases are currently down. We will have them back up soon!</span>
		</div>

<div class="grid-x grid-margin-x">
		<div class="auto cell no-margin">
			<h4>Store</h4>
		</div>
		<div class="shrink cell right no-margin">
        <?php if(Auth::check()): ?>
           
                <a href="<?php echo e(route('creator_area.index')); ?>"><button class="button button-green">
                  Create
                  </button></a>
        <?php endif; ?>
    </div>
</div>
<div class="store-topbar">
		<div class="grid-x align-middle grid-margin-x">
			<div class="auto cell no-margin">
				<ul>
                  <a href="<?php echo e(route('catalog.index', 'recent')); ?>">
					<li id="recent" data-category="recent" class="active">RECENT</li>
                  </a>
                   <?php $__currentLoopData = config('site.catalog_item_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a href="<?php echo e(route('catalog.index', $type)); ?>">
					<li id="<?php echo e(lcfirst(itemType($type, true))); ?>" data-category="<?php echo e(lcfirst(itemType($type, true))); ?>" onclick="switchCategory(\'<?php echo e($type); ?>\')" class="<?php if($type == 'home'): ?> active <?php endif; ?>"><?php echo e(Str::upper($type)); ?></li>
                  </a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		</div>
	</div>

<div class="container border-wh">
  <div class="grid-x grid-margin-x">
   <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="large-custom-2-4 medium-4 small-6 cell">
				<div class="border-r store-item-card">
					<div class="card-image" style="position:relative;">
                      
                      <div class="official-item-parent">
                        <div class="official-item-image" title="Official item sold by <?php echo e(config('site.name')); ?>"></div>
                      </div>
                        <a href="<?php echo e(route('catalog.item', [$item->id, $item->slug()])); ?>"><img src="<?php echo e($item->thumbnail()); ?>"></a>
                       </div>
					<div class="card-divider"></div>
					<div class="card-body">
						<div class="grid-x grid-margin-x">
							<div class="auto cell"> 
                                <div class="card-item-name"><a href="<?php echo e(route('catalog.item', [$item->id, $item->slug()])); ?>"><?php echo e($item->name); ?></a></div>
                                </div>
						</div>
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell text-left">
								<div class="card-item-creator">
                                           <a href="<?php echo e($item->creatorUrl()); ?>"><?php echo e($item->creatorName()); ?></a>
                              </div>
                           </div>
							<div class="shrink cell text-right">
                               <?php if($item->onsale() && $item->price == 0): ?>
                                               <div class="card-item-price"><font class="coins-text">Free</font></div>
                                            <?php elseif(!$item->onsale()): ?>
                                                 <div class="card-item-price"><font style="color: red;" class="coins-text">Offsale</font></div>
                                            <?php else: ?>
                                                <div class="card-item-price"><img src="<?php echo e(asset('img/bits-sm.png')); ?>"> <?php echo e(number_format($item->price)); ?></div>
                                            <?php endif; ?>
                              
                                            <?php if($item->limited): ?>
                                                <div class="bg-primary text-white text-center" style="border-radius:50%;width:30px;height:30px;position:absolute;margin-left:5px;margin-top:5px;">
                                                    <span style="font-size:20px;font-weight:600;margin-top:7px;">C</span>
                                                </div>
                                            <?php elseif($item->isTimed()): ?>
                                                <div class="bg-danger text-white text-center" style="border-radius:50%;width:30px;height:30px;position:absolute;margin-left:5px;margin-top:5px;">
                                                    <span style="font-size:17px;font-weight:600;"><i class="fas fa-clock" style="margin-top:6.5px;"></i></span>
                                                </div>
                                            <?php endif; ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                  </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-md-padding">
		No results found. Try refining your search.
		</div>
                        <?php endif; ?>
 </div><div class="push-25"></div></div>                               
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Store'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/catalog/index.blade.php ENDPATH**/ ?>