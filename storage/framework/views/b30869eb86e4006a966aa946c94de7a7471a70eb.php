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



<?php $__env->startSection('js'); ?>
    <script>
        function info(name, description, image)
        {
            $('#badge #badgeName').text(name);
            $('#badge #badgeDescription').text(description);
            $('#badge #badgeImage').attr('src', image);

            $('#badge').modal('show');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h3>Achievements</h3>
	<div class="container border-r md-padding">
		<div class="grid-x grid-margin-x align-middle">
		<style>
			.achievement-special {
				color: gold!important;
			}
			.achievement-text-small {
				font-size: 13px!important;
			}
		</style>
          <div class="large-2 cell achievement-container text-center">
                <?php $__empty_1 = true; $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                   
                        
                           <div class="achievement-image" style="background-image:url('<?php echo e($badge->image); ?>')"></div>
                            	<div class="achievement-title">
                                            
                                            <?php echo e($badge->name); ?>

                     </div>
                          <div class="achievement-info">
                            <?php echo e($badge->name); ?>

                            
                            <?php echo e($badge->description); ?>

                            
                                  </div>
                                 <div class="achievement-border"></div>
					<div class="achievement-description">
						<div class="padding-desc">
                        <?php echo e($badge->description); ?>

                          
                      </div>
                                  
                          </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
There are currently no badges.
                <?php endif; ?>
            </div>
        </div>
<div class="push-25"></div>
    <div class="modal fade" id="badge" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="badgeName"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <img id="badgeImage" width="100px">
                    <hr>
                    <p id="badgeDescription"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', [
    'title' => 'Badges'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/badges/index.blade.php ENDPATH**/ ?>