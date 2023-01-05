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



<?php $__env->startSection('meta'); ?>
    <meta
        name="game-info"
        data-id="<?php echo e($game->id); ?>"
        <?php if($game->is_active && Auth::check()): ?>
            data-launch="<?php echo e(Auth::user()->gameLaunch($game->id, 'client')); ?>"
        <?php endif; ?>
    >
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="col-10-12 push-1-12">
        <div class="card" style="margin-bottom:20px;">
            <div class="top blue"><?php echo e($game->name); ?></div>
            <div class="content" style="position:relative;">
                <div class="col-5-12" style="padding-right:0;">
                    <div class="box game-img">
                        <img src="<?php echo e($game->thumbnail()); ?>">
                    </div>
                </div>
                <div class="col-4-12" style="padding-left:10px;padding-right:0;">
                    <?php if(!$game->is_active): ?>
                        <div class="red-text mb2">This server is currently offline.</div>
                    <?php else: ?>
                        <div class="red-text mb2"><?php echo e($game->playing); ?> <?php echo e(($game->playing == 1) ? 'player' : 'players'); ?></div>
                        <button class="blue mb2" <?php echo (Auth::check()) ? 'id="play"' : ''; ?>>PLAY</button>
                    <?php endif; ?>

                    <?php if(Auth::check() && $game->creator->id == Auth::user()->id): ?>
                        <a href="<?php echo e(route('games.edit', $game->id)); ?>" class="button orange smaller-text">EDIT</a>
                        <button class="red smaller-text" data-modal-open="host">HOST</button>
                        <div class="modal" style="display:none;" data-modal="host">
                            <div class="modal-content">
                                <span class="close" data-modal-close="host">×</span>
                                <span>Hosting</span>
                                <hr>
                                <span>Hosting from the legacy server has been disabled. You can now only host using the Node-Hill server.</span>
                                <br>
                                <a href="https://brickhill.gitlab.io/open-source/node-hill/">Instructions to download are available <b>here.</b></a>
                                <div class="modal-buttons">
                                    <button type="button" class="cancel-button" data-modal-close="host">Cancel</button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="agray-text bold mt2" style="word-wrap:break-word;"><?php echo nl2br(e($game->description)); ?></div>
                    <div class="small-text mt6 mb2">
                        <div class="item-stats">
                            <span class="agray-text">Created:</span>
                            <span class="darkest-gray-text" title="<?php echo e($game->created_at->format('D, M d Y h:i A')); ?>"><?php echo e($game->created_at->format('M d, Y h:i A')); ?></span>
                        </div>
                        <div class="item-stats">
                            <span class="agray-text">Updated:</span>
                            <span class="darkest-gray-text" title="<?php echo e($game->updated_at->format('D, M d Y h:i A')); ?>"><?php echo e($game->updated_at->diffForHumans()); ?></span>
                        </div>
                        <div class="item-stats">
                            <span class="agray-text">Visits:</span>
                            <span class="darkest-gray-text"><?php echo e($game->visits); ?></span>
                        </div>
                    </div>
                    <span class="hover-cursor favorite-text" id="favorite">
                        <i class="far fa-star" <?php echo (Auth::check()) ? 'id="favoriteIcon"' : ''; ?>></i>
                        <span style="font-size: 0.9rem;" id="favoriteCount">0</span>
                    </span>
                    <?php if(Auth::check() && $game->creator->id != Auth::user()->id && !$game->creator->isStaff()): ?>
                        <a href="<?php echo e(route('report.index', ['set', $game->id])); ?>" class="red-text" style="margin-left:15px;">
                            <i class="far fa-flag"></i>
                            <span style="font-size: 0.9rem;">Report</span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-3-12 center-text">
                    <a href="<?php echo e(route('users.profile', $game->creator->id)); ?>">
                        <div class="game-creator-img">
                            <img class="width-100" src="<?php echo e($game->creator->thumbnail()); ?>">
                            <span class="bold"><?php echo e($game->creator->username); ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="top blue">Comments</div>
            <div class="content">
                <span>Coming soon.</span>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => $game->name,
    'image' => $game->thumbnail()
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/games/view.blade.php ENDPATH**/ ?>