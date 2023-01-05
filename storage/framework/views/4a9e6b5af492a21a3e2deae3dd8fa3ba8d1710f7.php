<?php if($paginator->hasPages()): ?>
       <div class="push-25"></div>
			<ul class="pagination" role="navigation" aria-label="Pagination">
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="pagination-previous disabled" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">Previous <span class="show-for-sr">page</span>
                    
                </li>
            <?php else: ?>
                <li class="pagination-previous">
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">Previous <span class="show-for-sr">page</span></a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li class="disabled" aria-disabled="true"><span><?php echo e($element); ?></span></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="current" aria-current="page"><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php else: ?>
                            <li><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="pagination-next">
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">Next <span class="show-for-sr">page</span></a>
                </li>
            <?php else: ?>
                <li class="pagination-next disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                    Next <span class="show-for-sr">page</span>
                </li>
            <?php endif; ?>
        </ul>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/vendor/pagination/aeo.blade.php ENDPATH**/ ?>