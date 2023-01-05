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
<div class="grid-x grid-margin-x">
		<div class="large-9 upgrade-offset cell">
			<div class="grid-x grid-margin-x">
				<div class="auto cell no-margin">
					<h4>Upgrades</h4>
				</div>
				<div class="shrink cell right">
					<a href="'.$serverName.'/upgrade/bits" class="button button-green">Buy Bits</a>
				</div>
				<div class="shrink cell right no-margin">
					<a href="'.$serverName.'/upgrade/credits" class="button button-grey">Buy Credits</a>
				</div>
				<div class="shrink cell right">
					<a href="'.$serverName.'/upgrade/code-redemption" class="button button-grey">Redeem Codes</a>
				</div>
			</div>
		</div>
	</div>
	<div class="push-25"></div>
	<div class="upgrade-title">MEMBERSHIPS</div>
	<div class="push-25"></div>
	<div class="grid-x grid-margin-x">
		<div class="large-3 medium-4 small-6 upgrade-offset cell" style="margin-left:460px;">
			<div class="container border-r">
				<div class="push-15"></div>
				<div class="upgrade-card-image" style="background:url(<?php echo e($image); ?>);"></div>
				<div class="upgrade-card-title"><?php echo e(config('site.membership_name')); ?></div>
				<div class="upgrade-card-price">$1<?php echo e($products['membership']['price']); ?>/mo</div>
				<div class="upgrade-card-inner">
					<div class="upgrade-card-info"><strong><?php echo e(config('site.daily_currency_membership')); ?></strong> Bits per day</div>
					<div class="upgrade-card-info">Create up to <strong><?php echo e(config('site.group_limit_membership')); ?></strong> games</div>
					<div class="upgrade-card-info">Create or join up to <strong><?php echo e(config('site.group_limit_membership')); ?></strong> groups</div>
				</div>
				<div class="upgrade-card-divider"></div>
				<div class="upgrade-card-button">
					<a href="<?php echo e(route('account.upgrade.checkout', str_replace('_', '-', $products['membership']['item_name']))); ?>">
						<button type="submit" class="button button-green" name="choose_2" <?php if(Auth::user()->hasMembership()): ?> disabled <?php endif; ?>>Choose</button>
					</a>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Upgrade'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/upgrade/index.blade.php ENDPATH**/ ?>