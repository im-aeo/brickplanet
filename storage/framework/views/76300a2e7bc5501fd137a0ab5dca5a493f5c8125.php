<?php $__env->startSection('meta'); ?>
    <meta name="group-info" data-id="<?php echo e($group->id); ?>" data-can-moderate-wall="<?php echo e(Auth::check() && Auth::user()->id == $group->owner->id); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .group-tabs .nav-link {
            border-radius: 0;
        }

        .group-tabs .nav-link:not(.active):hover {
            background: var(--section_bg_hover);
        }

        .group-tabs li:first-child .nav-link {
            border-radius: 8px 8px 0 0;
        }

        .group-tabs li:last-child .nav-link {
            border-radius: 0 0 8px 8px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/group.js?v=6')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="grid-x grid-margin-x view-group">
		<div class="large-3 medium-4 small-12 cell">
			<div class="container md-padding border-r" style="position:relative;">
				<img src="<?php echo e($group->thumbnail()); ?>" class="group-logo">
			</div>
			<div class="group-name"><span><?php echo e($group->name); ?></span></div>
			<div class="group-creator">Owner: <a href="<?php echo e(route('users.profile', $group->owner->username)); ?>"><?php echo e($group->owner->username); ?></a></div>
			';

			<?php if(Auth::user()->reachedGroupLimit()): ?>
				<div class="text-center"><strong>You have reached the limit of groups you can be apart of.</strong></div>
          
				<div class="push-10"></div>
			<?php elseif(Auth::user()->id != $group->owner->id): ?>
                        <form action="<?php echo e(route('groups.membership')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($group->id); ?>">

                            <?php if($group->is_private && $isPending): ?>
                                <button class="btn btn-block btn-secondary" disabled>Pending</button>
                            <?php elseif(!Auth::user()->isInGroup($group->id)): ?>
                                <button  class="button button-green groups-button" value="Join Group">Join</button>
                            <?php else: ?>
                                <button type="button" class="button button-red groups-button" value="Leave Group" data-open="LeaveModal">Leave Group</button>
                            <?php endif; ?>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('groups.manage', [$group->id, $group->slug()])); ?>" class="button button-grey groups-button">Group Settings</a>
                        <a href="<?php echo e(route('creator_area.index', ['gid' => $group->id])); ?>" class="button button-green groups-button">Create</a>
                    <?php endif; ?>
          
                          
                          
                          
		
		
				
				
				<div class="reveal item-modal" id="LeaveModal" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
					<div class="grid-x grid-margin-x align-middle">
						<div class="auto cell no-margin">
							<div class="modal-title">Confirm Action</div>
						</div>
						<div class="shrink cell no-margin">
							<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
					</div>
					<div class="bc-modal-contentText">
						<p>Are you sure you wish to leave this group? This action can not be undone.</p>
						<div align="center" style="margin-top:15px;">
							<form action="<?php echo e(route('groups.membership')); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="id" value="<?php echo e($group->id); ?>">
                              
								<input type="submit" class="button button-red store-button inline-block" name="leave_group" value="Leave Group">
								<input type="button" data-close class="button button-grey store-button inline-block" value="Go back">
								
							</form>
						</div>
					</div>
				</div>

			echo '
			<ul class="tabs view-group-tabs" data-tabs id="tabs">
				<li class="tabs-title is-active"><a href="#home" aria-selected="true">Home</a></li>
				<li class="tabs-title"><a href="#members">Members</a></li>
				
					
				<li class="tabs-title"><a href="#store">Store</a></li>
			</ul>
			<div class="push-25"></div>
			<div class="container border-r md-padding">
				 <?php if(Auth::check() && Auth::user()->isInGroup($group->id)): ?>
					<div class="group-info-content"><?php echo e(Auth::user()->rankInGroup($group->id)->name); ?></div>
					<div class="group-info-title">My Rank</div>
					<div class="push-15"></div>
					<?php endif; ?>
              
				<div class="group-info-content"><?php echo e(number_format($group->members()->count())); ?></div>
				<div class="group-info-title">Members</div>
				<?php if($group->is_vault_viewable): ?>
              
					<div class="push-15"></div>
					<div class="group-info-content coins-text" style="color:#f0be1d;"><?php echo e(number_format($group->vault)); ?> Bits</div>
					<div class="group-info-title">Group Vault</div>
			<?php endif; ?>

			
			</div>
			<div class="push-25"></div>
		</div>
		<div class="large-9 medium-8 small-12 cell">
			<div class="tabs-content" data-tabs-content="tabs">
				<div id="home" class="tabs-panel is-active">
					<div class="grid-x grid-margin-x">
						<div class="auto cell no-margin">
							<h5>About</h5>
						</div>
						<div clas="shrink cell no-margin right">
						';
						
						if ($AUTH) {
							
							echo '
							<div>
								<span class="group-settings" style="cursor:pointer;" data-toggle="group-'.$gG->ID.'-dropdown"><i class="material-icons">more_vert</i></span>
								<div class="dropdown-pane creator-area-dropdown wall-post-header" id="group-'.$gG->ID.'-dropdown" data-dropdown data-hover="false" data-hover-pane="true">
								';

								if ($AUTH && $gG->IsMember == 1 && $myU->FavoriteGroup != $gG->ID) {
									
									echo '
									<ul>
										<li>
											<form action="" method="POST">
												<span>
													<button type="submit" name="favorite_group" style="color:#ffffff;cursor:pointer;" title="Favorite this group">Favorite Group</button>
													<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">
												</span>
											</form>
										</li>
									</ul>
									<div class="creator-area-dropdown-divider"></div>
									';
									
								} else if ($AUTH && $gG->IsMember == 1 && $myU->FavoriteGroup == $gG->ID) {
									
									echo '
									<ul>
										<li>
											<form action="" method="POST">
												<span>
													<button type="submit" name="unfavorite_group" style="color:#ffffff;cursor:pointer;" title="Unfavorite this group">Unfavorite Group</button>
													<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">
												</span>
											</form>
										</li>
									</ul>
									<div class="creator-area-dropdown-divider"></div>
									';
								
								}

								echo '
								<ul>
									<li><form action="" method="POST"><button name="report_group" style="color:#ffffff;cursor:pointer;">Report Abuse</button></form></li>
								</ul>
								';

								echo '
								</div>
							</div>
							';
							
						}
						
						echo '
						</div>
					</div>
					<div class="container border-r md-padding">
						<div class="group-description">'.nl2br($gG->Description).'</div>
					</div>
					';

					if (!$AUTH || $AUTH && $GroupRanks[$MemberRankNum][2] == 1 || $AUTH && $myU->Admin > 0) {

						echo '
						<div class="push-25"></div>
						<div class="container md-padding border-r">
						<h5>Group Wall</h5>
						';

						//if (iss-
							//echo $returnWallError;

						//}

						if ($AUTH && $GroupRanks[$MemberRankNum][3] == 1) {

							echo '
							<form action="" method="POST">
								<textarea class="normal-input wall-textarea" name="wall" '; if ($myU->AccountVerified == 0) { echo 'disabled placeholder="Please verify your account to post on the group\'s wall."'; } else { echo 'placeholder="Write a message to the group\'s wall"'; } echo '></textarea>
								<div class="wall-options clearfix">
									<div class="float-right">
										<input type="submit" class="button button-green" value="Post"'; if ($myU->AccountVerified == 0) { echo ' disabled'; } echo '>
										<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">
									</div>
								</div>
							</form>
							<div class="push-15"></div>
							';

						}

						$limit = 10;

						$pages = ceil($gG->WallCount / $limit);

						$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
							'options' => array(
								'default'   => 1,
								'min_range' => 1,
							),
						)));

						$offset = ($page - 1)  * $limit;
						if ($offset < 0) { $offset = 0; }

						$getWall = $db->prepare("SELECT User.ID AS UserID, User.Username, User.AvatarURL, User.TimeLastSeen, UserGroupWall.ID, UserGroupWall.Message, UserGroupWall.TimePosted, UserGroupWall.IsPinned FROM UserGroupWall JOIN User ON User.ID = UserGroupWall.UserID WHERE UserGroupWall.GroupID = ".$gG->ID." ORDER BY UserGroupWall.IsPinned DESC, UserGroupWall.TimePosted DESC LIMIT ? OFFSET ?");
						$getWall->bindValue(1, $limit, PDO::PARAM_INT);
						$getWall->bindValue(2, $offset, PDO::PARAM_INT);
						$getWall->execute();

						while ($gW = $getWall->fetch(PDO::FETCH_OBJ)) {

							$UserOnlineColor = ($gW->TimeLastSeen + 600 > time()) ? '56A902' : 'AAAAAA';
							$StatusSpan = '<span class="user-online-status" style="background:#'.$UserOnlineColor.';"></span>';

							echo '
							<div class="wall-post">
								<div class="wall-post-header">
									<div class="grid-x grid-margin-x align-middle">
										';
										if ($gW->IsPinned == 1) {

											echo '
											<div class="shrink cell no-margin">
												<i class="material-icons group-pin" title="This is a pinned post">pin_drop</i>
											</div>
											';

										}
										echo '
										<div class="shrink cell no-margin">
											<div style="background-image:url(https://cdn.brickcreate.com/975289c5-1c08-463c-bdf5-0b49d35c933b.png);background-size:cover;" class="wall-post-avatar"></div>
										</div>
										<div class="auto cell no-margin">
											'.$StatusSpan.'
											<a href="'.$serverName.'/users/'.$gW->Username.'/" class="wall-post-username">'.$gW->Username.'</a>
										</div>
										<div class="shrink cell no-margin right">
											<span class="wall-post-time">'.get_timeago($gW->TimePosted).'</span>
											<span class="wall-settings" data-toggle="wall-'.$gW->ID.'-dropdown"><i class="material-icons">settings</i></span>
											<div class="dropdown-pane creator-area-dropdown" id="wall-'.$gW->ID.'-dropdown" data-dropdown data-hover="true" data-hover-pane="true">
											';

											if ($AUTH && ($gW->UserID == $myU->ID || $myU->Admin > 0 || $GroupRanks[$MemberRankNum][4] == 1)) {

												echo '<ul>';

												if ($gW->IsPinned == 0) {

													echo '
													<li><form action="" method="POST" style="display:inline;"><button type="submit" name="pin_wall">Pin Post</button><input type="hidden" name="wall_id" value="'.$gW->ID.'"><input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'"></form></li>
													';

												} else if ($gW->IsPinned == 1) {

													echo '
													<li><form action="" method="POST" style="display:inline;"><button type="submit" name="unpin_wall">Unpin Post</button><input type="hidden" name="wall_id" value="'.$gW->ID.'"><input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'"></form></li>
													';

												}

												echo '
												<form action="" method="POST" style="display:inline;"><button type="submit" name="delete_wall">Delete Post</button><input type="hidden" name="wall_id" value="'.$gW->ID.'"><input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'"></form>
												';

												echo '</ul><div class="creator-area-dropdown-divider"></div>';

											}

											if ($AUTH) {

												echo '<ul>';

												echo '
												<li><form action="" method="POST" style="display:inline;"><button type="submit" name="report_wall">Report Post</button><input type="hidden" name="wall_id" value="'.$gW->ID.'"><input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'"></form></li>
												';

												echo '</ul>';

											}

											echo '
											</div>
										</div>
									</div>
								</div>
								<div class="wall-post-main">
									'.nl2br($gW->Message).'
								</div>
							</div>
							';

						}

						if ($pages > 1) {

							echo '
							<div class="push-25"></div>
							<ul class="pagination" role="navigation" aria-label="Pagination">
								<li class="pagination-previous'; if ($page == 1) { echo ' disabled">Previous <span class="show-for-sr">page</span>'; } else { echo '"><a href="'.$serverName.'/groups/'.$gG->ID.'/'.str_replace(' ', '-', $gG->Name).'/?page='.($page-1).'">Previous <span class="show-for-sr">page</span></a>'; } echo '</li>
								';

								for ($i = max(1, $page - 5); $i <= min($page + 5, $pages); $i++) {

									if ($i <= $pages) {

										echo '<li'; if ($page == $i) { echo ' class="current"'; } echo ' aria-label="Page '.$i.'"><a href="'.$serverName.'/groups/'.$gG->ID.'/'.str_replace(' ', '-', $gG->Name).'/?page='.($i).'">'.$i.'</a></li>';

									}

								}

								echo '
								<li class="pagination-next'; if ($page == $pages) { echo ' disabled" aria-label="Previous page">Next <span class="show-for-sr">page</span>'; } else { echo '"><a href="'.$serverName.'/groups/'.$gG->ID.'/'.str_replace(' ', '-', $gG->Name).'/?page='.($page+1).'">Next <span class="show-for-sr">page</span></a>'; } echo '</li>
							</ul>
							';

						}

						echo '
						</div>
						';

					}

					echo '
				</div>
				<div id="members" class="tabs-panel '; if ($gG->IsMember == 0 && $gG->NonMemberTab == 2 || $gG->IsMember == 1 && $gG->MemberTab == 2) { echo 'is-active'; } echo '">
					<div class="container border-r md-padding">
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell">
								<h5>Members</h5>
							</div>
							<div class="shrink cell right">
								<select class="normal-input" onchange="switchRank(this.value)">
								';

								foreach ($GroupRanks as $key => $value) {

									echo '<option value="'.$key.'">'.htmlentities(strip_tags($value[0])).' ('.number_format($value[1]).')</option>';

								}

								echo '
								</select>
							</div>
						</div>
						<div class="push-10"></div>
						<div id="MembersDiv"></div>
					</div>
				</div>
				';

				if ($gG->OwnerType == 0) {

					echo '
					<div id="divisions" class="tabs-panel '; if ($gG->IsMember == 0 && $gG->NonMemberTab == 3 || $gG->IsMember == 1 && $gG->MemberTab == 3) { echo 'is-active'; } echo '">
						<h5>Divisions</h5>
						<div class="container border-r md-padding">
							<div id="DivisionsDiv"></div>
						</div>
					</div>
					';

				}

				echo '
				<div id="store" class="tabs-panel '; if ($gG->IsMember == 0 && $gG->NonMemberTab == 4 || $gG->IsMember == 1 && $gG->MemberTab == 4) { echo 'is-active'; } echo '">
					<h5>Store</h5>
					<div class="container border-r md-padding">
						<div id="StoreDiv"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	';
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', [
    'title' => $group->name,
    'image' => $group->thumbnail()
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/groups/view.blade.php ENDPATH**/ ?>