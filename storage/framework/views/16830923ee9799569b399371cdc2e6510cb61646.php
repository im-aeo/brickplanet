<?php $__env->startSection('meta'); ?>
    <meta name="routes" data-apply="<?php echo e(route('jobs.listings.apply')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        var routes = {}
        var applying = false;

        $(() => {
            const meta = 'meta[name="routes"]';
            routes.apply = $(meta).attr('data-apply');

            $('[data-toggle="apply"]').click(function() {
                applying = !applying;

                if (applying) {
                    $('#view').hide();
                    $('#apply').show();
                } else {
                    $('#view').show();
                    $('#apply').hide();
                }
            });

            $('#apply form').submit(function(event) {
                event.preventDefault();

                const uid = $(this).find('input[name="uid"]').val();
                const name = $(this).find('input[name="name"]').val();
                const email = $(this).find('input[name="email"]').val();
                const why_work = $(this).find('textarea[name="why_work"]').val();
                const why_choose = $(this).find('textarea[name="why_choose"]').val();
                const how_find = $(this).find('textarea[name="how_find"]').val();

                $.post(routes.apply, { _token, uid, name, email, why_work, why_choose, how_find }).done((data) => {
                    $('.text-danger').html('');
                    $('.alert').html('');

                    if (typeof data.errors !== 'undefined')
                        for (const [name, messages] of Object.entries(data.errors)) {
                            var string = '';

                            messages.forEach((message) => string += `<div>${message}</div>`);

                            $(`#${name}`).html(string);
                        }
                    else
                        window.location = data.url;
                }).fail(() => {
                    $('.text-danger').html('');
                    $('.alert').html('Unable to submit application.').show()
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="grid-container"><div class="site-header-margin"></div>
		<div class="preview-title"><?php echo e($listing->title); ?></div>
		<div class="grid-x grid-margin-x align-middle">
			<div class="shrink cell no-margin">
				<div class="ico-group">
					<i class="material-icons">home</i>
					<span>Remote</span>
				</div>
			</div>
			<div class="auto cell text-right">
              <?php if(Auth::check()): ?>
					<input type="button" name="bp-jobSubmitApply"  value="You're Already Staff" class="preview-apply-button">
              <?php else: ?>
              <a href="<?php echo e(route('jobs.login.index')); ?>">
					<input type="button" name="bp-jobSubmitApply" value="Apply" class="preview-apply-button">
				</a>
              <?php endif; ?>
			</div>
		</div>
		<div class="preview-content">
			<div class="preview-content-shrink">
              <?php echo nl2br($listing->body); ?>

            <div id="apply" style="display:none;">
                <h3>
                    <button class="btn btn-sm btn-outline-danger mr-2" data-toggle="apply"><i class="fas fa-arrow-left mr-1"></i> Cancel</button>
                    <i class="fas fa-briefcase mr-1" style="font-size:25px;"></i>
                    <span>Apply</span>
                </h3>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="alert bg-danger text-white" id="error" style="display:none;"></div>
                        <form>
                            <input type="hidden" name="uid" value="<?php echo e($listing->uid); ?>">
                            <label for="name">Your Name</label>
                            <input class="form-control " type="text" name="name" placeholder="Your Name" required>
                            <div class="text-danger mb-2" id="name"></div>
                            <label for="email">Your Email Address</label>
                            <input class="form-control" type="email" name="email" placeholder="Your Email Address" required>
                            <div class="text-danger mb-2" id="email"></div>
                            <label for="why_work">Why do you want to work at <?php echo e(config('site.name')); ?>?</label>
                            <textarea class="form-control" name="why_work" placeholder="Why do you want to work at <?php echo e(config('site.name')); ?>?" rows="5" required></textarea>
                            <div class="text-danger mb-2" id="why_work"></div>
                            <label for="why_choose">Why should we choose you?</label>
                            <textarea class="form-control" name="why_choose" placeholder="Why should we choose you?" rows="5" required></textarea>
                            <div class="text-danger mb-2" id="why_choose"></div>
                            <label for="how_find">How did you find <?php echo e(config('site.name')); ?>?</label>
                            <textarea class="form-control" name="how_find" placeholder="How did you find <?php echo e(config('site.name')); ?>?" rows="5" required></textarea>
                            <div class="text-danger mb-3" id="how_find"></div>
                            <button class="btn btn-block btn-outline-success" type="submit">Send Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.jobs', [
    'title' => "Apply for {$listing->title}"
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/jobs/listings/view.blade.php ENDPATH**/ ?>