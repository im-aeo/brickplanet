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
		<div class="auto cell">
			<h3>Games - <?php echo e($games->count()); ?> Servers Online</h3>
		</div>
	</div>
	<div class="push-15"></div>
	<div class="grid-x grid-margin-x">
        <?php $__empty_1 = true; $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="large-3 cell">
                   <a href="<?php echo e(route('games.view', $game->id)); ?>">
                            <div style="width:100%;height:250px;background-image:url(<?php echo e($game->thumbnail()); ?>);background-size:cover;background-color:#17171C;" class="relative">
                              <div class="user-game-ingame"><span><?php echo e($game->playing); ?> In Game</span></div>
                     </div>
                        </a>
             <div class="container sm-padding">
				<div class="grid-x grid-margin-x align-middle">
					<div class="shrink cell no-margin">
                      <a href="<?php echo e(route('users.profile', $game->creator->id)); ?>">
                        <div class="user-game-user-thumbnail relative" style="background-image:url({ $game->creator->headshot() }});"></div>
                      </a>
                  </div>
                    <div class="auto cell no-margin">
						<div class="user-game-info">
							<a href="<?php echo e(route('games.view', $game->id)); ?>" class="ug-info-title"><?php echo e($game->name); ?></a>
							<div class="ug-info-creator">By <a href="<?php echo e(route('users.profile', $game->creator->id)); ?>"><?php echo e($game->creator->username); ?></a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="push-25"></div><div class="push-10"></div>
		</div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center bold">There are no servers currently online :(</div>
        <?php endif; ?>
    </div>
    <div class="col-1-1 pages blue"><?php echo e($games->onEachSide(1)); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Play'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/games/index.blade.php ENDPATH**/ ?>