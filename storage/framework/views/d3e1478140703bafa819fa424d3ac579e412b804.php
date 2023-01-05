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
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        .transaction:not(:last-child) {
            margin-bottom: 16px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="grid-x grid-margin-x align-middle">
		<div class="auto cell no-margin">
			<h4>Creator Area - <?php echo e(ucfirst($category)); ?></h4>
		</div>
</div>
    <div class="push-15"></div>
	<ul class="tabs grid-x grid-margin-x profile-tabs" data-tabs id="tabs" role="tablist">
                <li class="no-margin tabs-title cell <?php if($category == 'purchases'): ?> is-active <?php endif; ?>">
                    <a href="<?php echo e(route('account.money.index', 'purchases')); ?>">Purchases</a>
                </li>
                <li class="no-margin tabs-title cell <?php if($category == 'sales'): ?> is-active <?php endif; ?>">
                    <a href="<?php echo e(route('account.money.index', 'sales')); ?>">Sales</a>
                </li>
      <li class="no-margin tabs-title cell">
                    <a href="<?php echo e(route('creator_area.index')); ?>">Create</a>
                </li>
            </ul>
			<div class="container border-r md-padding" style="border-radius: 0px;">
            <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="grid-x grid-margin-x align-middle creator-area-trans">
							<div class="shrink cell">
                              
                              <a href="<?php echo e(route('catalog.item', [$transaction->item->id, $transaction->item->slug()])); ?>">
                                
                                <div class="creator-area-trans-pic" 
                                     style="background:url('<?php echo e(($category == 'purchases') ? Auth::user()->headshot() : $transaction->buyer->headshot()); ?>') no-repeat;background-size:48px 48px;background-position: center center;border-radius: 100%;"></div></a>
                                     
                  </div>
                                <div class="auto cell">
                           <a href="#"><?php echo e(($category == 'purchases' or $transaction->buyer->username == Auth::user()->username) ? 'You' : $transaction->buyer->username); ?></a> purchased <a href="<?php echo e(route('catalog.item', [$transaction->item->id, $transaction->item->slug()])); ?>"><?php echo e($transaction->item->name); ?></a> from <a href="<?php echo e(route('users.profile', $transaction->sellerName())); ?>"><?php echo e($transaction->sellerName()); ?></a> for <font class="coins-text"><?php if($transaction->price > 0): ?>
                            <?php echo e(number_format($transaction->price)); ?> Bits
                        <?php else: ?>
                            Free
                        <?php endif; ?>
                                  
                                  
                                  </font>
							</div>
							<div class="shrink cell right">
								<?php echo e($transaction->created_at->format('M d, Y')); ?>

							</div>
						</div>
              <div class="creator-area-trans-divider"></div>
              
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              No <?php echo e(ucfirst($category)); ?> found.
              <?php endif; ?>
                                
</div>    
                        
    <?php echo e($transactions->onEachSide(1)); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Money'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/money.blade.php ENDPATH**/ ?>