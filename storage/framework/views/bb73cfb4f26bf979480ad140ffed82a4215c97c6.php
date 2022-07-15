
<div class="grid-x grid-margin-x">
		<div class="<?php if(auth()->guard()->check()): ?> large-9 <?php else: ?> cell <?php endif; ?>">
			<div class="container-header strong forum-header">
				<div class="grid-x grid-margin-x align-middle">
					<div class="large-7 medium-8 small-8 cell">
						Forum
					</div>
					<div class="large-1 medium-2 small-2 cell text-center">
						Replies
					</div>
					<div class="large-1 medium-2 small-2 cell text-center">
						Views
					</div>
					<div class="large-3 cell text-right show-for-large">
						Last Post
					</div>
				</div>
			</div>
			<div class="container border-wh">
              <?php if(auth()->guard()->check()): ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/web/forum/_header2.blade.php ENDPATH**/ ?>