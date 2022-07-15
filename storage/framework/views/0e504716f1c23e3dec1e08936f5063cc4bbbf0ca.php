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
			<ul class="tabs grid-x grid-margin-x settings-tabs" data-tabs id="tabs" role="tablist">
            
                <li class="no-margin tabs-title cell <?php if($category == 'general'): ?> is-active <?php endif; ?>">
                    <a href="<?php echo e(route('account.settings.index', 'general')); ?>">General</a>
                </li>
                <li class="no-margin tabs-title cell <?php if($category == 'privacy'): ?> is-active <?php endif; ?>">
                    <a href="<?php echo e(route('account.settings.index', 'privacy')); ?>">Privacy</a>
                </li>
                <li class="no-margin tabs-title cell <?php if($category == 'password'): ?> is-active <?php endif; ?>">
                    <a href="<?php echo e(route('account.settings.index', 'password')); ?>">Password</a>
                </li>
                <li class="no-margin tabs-title cell <?php if($category == 'appearance'): ?> is-active <?php endif; ?>">
                    <a href="<?php echo e(route('account.settings.index', 'appearance')); ?>">Appearance</a>
                </li>
            </ul>
        </div>
</div>
   
            <form action="<?php echo e(route('account.settings.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="category" value="<?php echo e($category); ?>">

                <?php if($category == 'general'): ?>
                    <h5>General Account Settings</h5>
                    <div class="container border-r lg-padding">
						<div class="grid-x grid-margin-x align-middle">
                          <div class="large-2 large-offset-1 cell text-right">
								<strong>Username</strong>
							</div>
                          <div class="large-7 cell">
								<div class="grid-x grid-margin-x align-middle">
									<div class="shrink cell no-margin">
										<input class="normal-input" type="text" name="username" placeholder="Username" value="<?php echo e(Auth::user()->username); ?>">
									</div>
                                  
                    <div class="row mb-3">
                        <div class="col-4 col-md-2 align-self-center"><strong>User ID:</strong></div>
                        <div class="col-8 col-md-10 mt-1 mb-1">
                            <input class="form-control" type="number" placeholder="ID" value="<?php echo e(Auth::user()->id); ?>" disabled>
                        </div>
                        <div class="col-4 col-md-2 align-self-center"><strong>Username:</strong></div>
                        <div class="col-8 col-md-10 mt-1 mb-1">
                            <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo e(Auth::user()->username); ?>">
                        </div>
                        <div class="col-4 col-md-2 align-self-center"><strong>Email:</strong></div>
                        <div class="col-8 col-md-10 mt-1 mb-1">
                            <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo e(Auth::user()->email); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Description</h3>
                            <hr>
                            <textarea class="form-control mb-3" name="description" placeholder="Hi there, my name is <?php echo e(Auth::user()->username); ?>!" rows="5"><?php echo e(Auth::user()->description); ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <h3>Forum Signature</h3>
                            <hr>
                            <input class="form-control mb-3" name="forum_signature" placeholder="Forum Signature" value="<?php echo e(Auth::user()->forum_signature); ?>">
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">Update</button>
                <?php elseif($category == 'privacy'): ?>
                    <h3>Privacy & Security</h3>
                    <hr>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="accepts_messages" <?php if(Auth::user()->setting->accepts_messages): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="accepts_messages">Accepts Messages</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="accepts_friends" <?php if(Auth::user()->setting->accepts_friends): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="accepts_friends">Accepts Friends</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="accepts_trades" <?php if(Auth::user()->setting->accepts_trades): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="accepts_trades">Accepts Trades</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="public_inventory" <?php if(Auth::user()->setting->public_inventory): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="public_inventory">Public Inventory</label>
                    </div>
                    <button class="btn btn-success" type="submit">Update</button>
                <?php elseif($category == 'password'): ?>
                    <h3>Change Password</h3>
                    <hr>
                    <label for="current_password">Current Password</label>
                    <input class="form-control mb-2" type="password" name="current_password" placeholder="Current Password" required>
                    <label for="new_password">New Password</label>
                    <input class="form-control mb-2" type="password" name="new_password" placeholder="New Password" required>
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input class="form-control mb-3" type="password" name="new_password_confirmation" placeholder="Confirm New Password" required>
                    <button class="btn btn-success" type="submit">Change</button>
                <?php elseif($category == 'appearance'): ?>
                    <h3>Appearance</h3>
                    <hr>
                    <select class="form-control mb-3" name="theme">
                        <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($theme); ?>" <?php if(Auth::user()->setting->theme == $theme): ?> selected <?php endif; ?>><?php echo e(ucwords(str_replace('_', ' ', $theme))); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button class="btn btn-success" type="submit">Update</button>
                    <div class="mb-3"></div>
                    <small class="text-muted">More appearance settings coming soon.</small>
                <?php endif; ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Settings'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/account/settings.blade.php ENDPATH**/ ?>