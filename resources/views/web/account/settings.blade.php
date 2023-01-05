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

@extends('layouts.default', [
    'title' => 'Settings'
])

@section('content')
<div class="grid-x grid-margin-x">
		<div class="auto cell">
			<ul class="tabs grid-x grid-margin-x settings-tabs" data-tabs id="tabs">
				<li class="no-margin tabs-title cell is-active" aria-selected="true"><a href="#account">Account</a></li>
				<li class="no-margin tabs-title cell"><a href="#privacy">Privacy & Security</a></li>
				<li class="no-margin tabs-title cell"><a href="#password">Password</a></li>
				<li class="no-margin tabs-title cell"><a href="#billing" class="no-right-border">Billing</a></li>
			</ul>
			<div class="tabs-content" data-tabs-content="tabs">
				<div id="account" class="tabs-panel is-active">
					<h5>Account</h5>
					<div class="container border-r lg-padding">
						<div class="grid-x grid-margin-x align-middle">
							<div class="large-2 large-offset-1 cell text-right">
								<strong>Username</strong>
							</div>
							<div class="large-7 cell">
								<div class="grid-x grid-margin-x align-middle">
									<div class="shrink cell no-margin">
										<div class="settings-content">{{ Auth::user()->username }}</div>
									</div>
									
									@if (Auth::user()->currency >= 2500)
									<div class="shrink cell no-margin">
										<button type="button" class="button button-blue settings-button-cu" data-open="ChangeUsername">Change</button>
										<div class="reveal item-modal" id="ChangeUsername" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
											<form action="{{ route('account.settings.update') }}" method="POST">
                                              @csrf
                                                <input type="hidden" name="setting" value="account">
												<div class="grid-x grid-margin-x align-middle">
													<div class="auto cell no-margin">
														<div class="modal-title">Change Username</div>
													</div>
													<div class="shrink cell no-margin">
														<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
													</div>
												</div>
												<div class="push-15"></div>
												<input type="text" class="normal-input" name="username" placeholder="New Username">
												<div class="push-15"></div>
												<div>Changing your username will cost <font class="coins-text">2,500 Bits</font></div>
												<div class="push-25"></div>
												<div align="center">
													<input type="submit" class="button button-green store-button inline-block" name="save_new_username" value="Change">
													<input type="button" data-close class="button button-grey store-button inline-block" value="Go back">
												</div>
											</form>
										</div>
									</div>
									@else
									<span class="settings-content-info has-tip right" data-tooltip aria-haspopup="true" data-disable-hover="false" tabindex="2" title="You need at least 2,500 Bits to change your username."><i class="material-icons">info_outline</i></span>
                                  @endif
								</div>
							</div>
						</div>
						<div class="push-25"></div>
						<div class="grid-x grid-margin-x align-middle">
							<div class="large-2 large-offset-1 cell text-right">
								<strong>Email</strong>
							</div>
							<div class="large-7 cell">
								<div class="grid-x grid-margin-x align-middle">
									<div class="shrink cell no-margin">
										<div class="settings-content">{{ Auth::user()->email }}</div>
									</div>
									
									<div class="shrink cell no-margin">
										<button type="button" class="button button-blue settings-button-cu" data-open="ChangeEmail">Change</button>
										<div class="reveal item-modal" id="ChangeEmail" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
											<form action="" method="POST">
												<div class="grid-x grid-margin-x align-middle">
													<div class="auto cell no-margin">
														<div class="modal-title">Change Email Address</div>
													</div>
													<div class="shrink cell no-margin">
														<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
													</div>
												</div>
												<div class="push-15"></div>
												<input type="email" class="normal-input" name="current_email" placeholder="Current Email">
												<div style="height:15px;"></div>
												<input type="email" class="normal-input" name="new_email" placeholder="New Email">
												<div class="push-25"></div>
												<div align="center">
													<input type="submit" class="button button-green store-button inline-block" name="save_new_email" value="Change">
													<input type="button" data-close class="button button-grey store-button inline-block" value="Go back">
													<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="push-25"></div>
						<form action="" method="POST">
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-2 large-offset-1 cell text-right">
									<strong>Gender</strong>
								</div>
								<div class="large-7 cell">
									<select class="normal-input" name="gender" style="width:200px;">
										<option value="0"'; if ($myU->Gender == 0) { echo ' selected'; } echo '>Male</option>
										<option value="1"'; if ($myU->Gender == 1) { echo ' selected'; } echo '>Female</option>
										<option value="2"'; if ($myU->Gender == 2) { echo ' selected'; } echo '>Other</option>
									</select>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-2 large-offset-1 cell text-right">
									<strong>Avatar</strong>
								</div>
								<div class="large-7 cell">
									<select class="normal-input" name="avatar" style="width:200px;">
										<option value="0"'; if ($myU->Avatar == 0) { echo ' selected'; } echo '>Male</option>
										<option value="1"'; if ($myU->Avatar == 1) { echo ' selected'; } echo '>Female</option>
									</select>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-2 large-offset-1 cell text-right">
									<strong>Birth Date</strong>
								</div>
								<div class="large-7 cell">
									<select name="birthdate_month" id="birthdate_month" class="normal-input" style="display:inline-block;width:48%;">
										';

										if ($myU->BirthdateMonth == 0) {

											echo '<option value="0" selected>Select...</option>';

										}

										echo '
										<option value="1"'; if ($myU->BirthdateMonth == 1) { echo ' selected'; } echo '>January</option>
										<option value="2"'; if ($myU->BirthdateMonth == 2) { echo ' selected'; } echo '>February</option>
										<option value="3"'; if ($myU->BirthdateMonth == 3) { echo ' selected'; } echo '>March</option>
										<option value="4"'; if ($myU->BirthdateMonth == 4) { echo ' selected'; } echo '>April</option>
										<option value="5"'; if ($myU->BirthdateMonth == 5) { echo ' selected'; } echo '>May</option>
										<option value="6"'; if ($myU->BirthdateMonth == 6) { echo ' selected'; } echo '>June</option>
										<option value="7"'; if ($myU->BirthdateMonth == 7) { echo ' selected'; } echo '>July</option>
										<option value="8"'; if ($myU->BirthdateMonth == 8) { echo ' selected'; } echo '>August</option>
										<option value="9"'; if ($myU->BirthdateMonth == 9) { echo ' selected'; } echo '>September</option>
										<option value="10"'; if ($myU->BirthdateMonth == 10) { echo ' selected'; } echo '>October</option>
										<option value="11"'; if ($myU->BirthdateMonth == 11) { echo ' selected'; } echo '>November</option>
										<option value="12"'; if ($myU->BirthdateMonth == 12) { echo ' selected'; } echo '>December</option>
									</select>
									<select name="birthdate_day" id="birthdate_day" class="normal-input" style="display:inline-block;width:25%;">
										';

										for ($i = 1; $i < 32; $i++) {

											if ($i < 10) { $i = 0 . $i; }

											echo '<option value="'.$i.'"'; if ($myU->BirthdateDay == $i) { echo ' selected'; } echo '>'.$i.'</option>';

										}

										echo '
									</select>
									<select name="birthdate_year" id="birthdate_year" class="normal-input" style="display:inline-block;width:25%;">
										';

										if ($myU->BirthdateYear == 0) {

											echo '<option value="0" selected>Select...</option>';

										}

										$date_year = date('Y');
										$hundred_years = date('Y') - 100;

										for ($i = $date_year; $i >= $hundred_years; $i--) {

											echo '<option value="'.$i.'"'; if ($myU->BirthdateYear == $i) { echo ' selected'; } echo '>'.$i.'</option>';

										}

										echo '
									</select>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-2 large-offset-1 cell text-right">
									<strong>Country</strong>
								</div>
								<div class="large-7 cell">
									<select name="country" id="country" class="normal-input">
										';

										if (is_numeric($myU->Country)) {

											echo '
											<option value="0">Select...</option>
											';

										}

										foreach ($countries as $key => $value) {

											echo '
											<option value="'.$key.'"'; if (!is_numeric($myU->Country) && $myU->Country == $key) { echo ' selected'; } echo '>'.$value.'</option>
											';

										}

										echo '
									</select>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-2 large-offset-1 cell text-right">
									<strong>Profile Blurb</strong>
								</div>
								<div class="large-7 cell">
									<textarea name="blurb" id="blurb" class="normal-input settings-blurb" length="1000">'.$myU->About.'</textarea>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-7 large-offset-3 cell">
									<input type="submit" name="settings_save" class="button button-green" value="Save" style="margin:0 auto;">
								</div>
							</div>
						</form>
					</div>
				</div>
				<div id="privacy" class="tabs-panel">
					<h5>Security Features</h5>
					<form action="" method="POST">
						<div class="container lg-padding border-r">
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Choose whether or not you want to disable other countries accessing your account, and allow only your country to access your account. Enabled by default.">Restrict access from other countries?</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="country_restrict" id="country_restrict" value="1"'; if ($myU->CountryRestrict == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="country_restrict"></label>
									</div>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Send an email when major actions happen (large purchase, sign-in, password change, etc). Enabled by default.">Allow email notifications?</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="email_notifications" id="email_notifications" value="1"'; if ($myU->EmailNotifications == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="email_notifications"></label>
									</div>
								</div>
							</div>
						</div>
						<div class="push-25"></div>
					</form>

					<h5>Two Step Verification</h5>
					<div class="container lg-padding border-r">
							<p>Two Step Verification adds an extra layer of security to your account by requiring an unique code once you sign in.<br>
							<b>Note</b>: You will require a mobile app named Google Authenticator or Authy</p><div id="twoStepContainer">
							<div id="disabled2fa" style="display:none">
								<button id="etfaBtn" class="button button-green" onclick="enableTwoStep();">Enable</button>
							</div>

							<div id="init2fa" style="display:none">
								<p>Two Step Verification has been enabled, however we need to verify you can sign in afterwards.<br>
								<b id="codeContainer"></b><br>
								<div id="qrContainer"></div>
								Now, we have to get the code. To do this, open either Google Authenticator or Authy and:<br>
								1. Scan the given QR code <b>OR</b><br>
								2. Use the given key<br><br>
								Once you do that, you should get a 6 digit code that will re-generate every 30 seconds.
								Please enter your two step verification code in the box below:</p>
								<input type="number" id="2faInitCode" maxlength="6" class="forum-input" placeholder="Two Step Verification Code here">
								<div class="push-5"></div>
								<div id="2faErrorContainer"></div>
								<button id="itfabtn" class="button button-green" onclick="finishStepSetup();">Finish Setup</button>
							</div>

							<div id="enabled2fa" style="display:none">
								<p>Two Step Verification has been enabled. You will be asked for a code the next time you sign in.<br>
								<b id="fcodeContainer"></b><br>
								<div id="fqrContainer"></div>
								If you wish to disable this security feature, click the button below:<br>
								<button id="etfabtn" class="button button-green" onclick="disableTwoStep();">Disable Two Step Verification</button>
							</div>';
							if ($myU->TwoStepEnabled == 0 && $myU->TwoStepInit == 0)
								echo '<script>$("#disabled2fa").show();</script>';
							elseif ($myU->TwoStepInit == 1)
								echo '<script>createInitView("'.$myU->TwoStepPrivateKey.'", "'.$gAuth->getURL($myU->Username, 'planetrune.com', $myU->TwoStepPrivateKey).'");</script>';
							elseif ($myU->TwoStepEnabled == 1)
								echo '<script>createEnabledView("'.$myU->TwoStepPrivateKey.'", "'.$gAuth->getURL($myU->Username, 'planetrune.com', $myU->TwoStepPrivateKey).'");</script>';
					echo '</div></div>

					<div class="push-25"></div>
					<form action="" method="POST">
						<h5>Privacy</h5>
						<div class="container lg-padding border-r">
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-4 large-offset-1 cell text-right">
									<strong>Who can send me chats?</strong>
								</div>
								<div class="large-3 cell">
									<select name="messages_privacy" id="messages_privacy" class="normal-input">
										<option value="0"'; if ($myU->PrivateMessageSettings == 0) { echo ' selected'; } echo '>Everyone</option>
										<option value="1"'; if ($myU->PrivateMessageSettings == 1) { echo ' selected'; } echo '>Friends Only</option>
										<option value="2"'; if ($myU->PrivateMessageSettings == 2) { echo ' selected'; } echo '>No One</option>
									</select>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-4 large-offset-1 cell text-right">
									<strong>Who can add me as a friend?</strong>
								</div>
								<div class="large-3 cell">
									<select name="friends_privacy" id="friends_privacy" class="normal-input">
										<option value="0"'; if ($myU->FriendRequestSettings == 0) { echo ' selected'; } echo '>Everyone</option>
										<option value="1"'; if ($myU->FriendRequestSettings == 1) { echo ' selected'; } echo '>No One</option>
									</select>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-4 large-offset-1 cell text-right">
									<strong>Who can send me trades?</strong>
								</div>
								<div class="large-3 cell">
									<select name="trade_privacy" id="trade_privacy" class="normal-input">
										<option value="0"'; if ($myU->TradeSettings == 0) { echo ' selected'; } echo '>Everyone</option>
										<option value="1"'; if ($myU->TradeSettings == 1) { echo ' selected'; } echo '>Friends Only</option>
										<option value="2"'; if ($myU->TradeSettings == 2) { echo ' selected'; } echo '>No One</option>
									</select>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-4 large-offset-1 cell text-right">
									<strong>Who can post on my wall?</strong>
								</div>
								<div class="large-3 cell">
									<select name="postwall_privacy" id="postwall_privacy" class="normal-input">
										<option value="0"'; if ($myU->PostWallSettings == 0) { echo ' selected'; } echo '>Everyone</option>
										<option value="1"'; if ($myU->PostWallSettings == 1) { echo ' selected'; } echo '>Friends Only</option>
										<option value="2"'; if ($myU->PostWallSettings == 2) { echo ' selected'; } echo '>No One</option>
									</select>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-4 large-offset-1 cell text-right">
									<strong>Who can view my wall?</strong>
								</div>
								<div class="large-3 cell">
									<select name="viewwall_privacy" id="viewwall_privacy" class="normal-input">
										<option value="0"'; if ($myU->ViewWallSettings == 0) { echo ' selected'; } echo '>Everyone</option>
										<option value="1"'; if ($myU->ViewWallSettings == 1) { echo ' selected'; } echo '>Friends Only</option>
										<option value="2"'; if ($myU->ViewWallSettings == 2) { echo ' selected'; } echo '>No One</option>
									</select>
								</div>
							</div>
						</div>
						<div class="push-25"></div>
						<h5>Notifications</h5>
						<div class="container lg-padding border-r">
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Receive notifications about chats">Receive notifications about chats</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="notification_settings_chats" id="notification_settings_chats" value="1"'; if ($myU->NotificationSettingsChats == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="notification_settings_chats"></label>
									</div>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Receive notifications about incoming trades">Receive notifications about incoming trades</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="notification_settings_incoming_trades" id="notification_settings_incoming_trades" value="1"'; if ($myU->NotificationSettingsIncomingTrades == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="notification_settings_incoming_trades"></label>
									</div>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Receive notifications when you sell an item">Receive notifications when you sell an item</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="notification_settings_sell_item" id="notification_settings_sell_item" value="1"'; if ($myU->NotificationSettingsSellItem == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="notification_settings_sell_item"></label>
									</div>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Receive notifications about new blog posts">Receive notifications about new blog posts</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="notification_settings_blog" id="notification_settings_blog" value="1"'; if ($myU->NotificationSettingsBlog == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="notification_settings_blog"></label>
									</div>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Receive notifications for friend requests">Receive notifications for friend requests</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="notification_settings_friend_requests" id="notification_settings_friend_requests" value="1"'; if ($myU->NotificationSettingsFriendRequests == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="notification_settings_friend_requests"></label>
									</div>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Receive notifications from groups">Receive notifications from groups</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="notification_settings_groups" id="notification_settings_groups" value="1"'; if ($myU->NotificationSettingsGroups == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="notification_settings_groups"></label>
									</div>
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x">
								<div class="large-4 large-offset-1 cell text-right">
									<strong data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="2" title="Receive notifications for your profile wall">Receive notifications for your profile wall</strong>
								</div>
								<div class="large-5 cell">
									<div class="switch tiny">
										<input class="switch-input" type="checkbox" name="notification_settings_wall" id="notification_settings_wall" value="1"'; if ($myU->NotificationSettingsWall == 1) { echo ' checked'; } echo '>
										<label class="switch-paddle" for="notification_settings_wall"></label>
									</div>
								</div>
							</div>
						</div>
						<div class="push-25"></div>
						<div class="grid-x grid-margin-x align-middle">
							<div class="large-3 large-offset-5 cell">
								<input type="submit" name="privacy_save" class="button button-green" value="Save" style="margin:0 auto;">
							</div>
						</div>
					</form>
					<div class="push-25"></div>
					<div class="grid-x grid-margin-x align-middle">
						<div class="auto cell no-margin">
							<h5>Blocked Users</h5>
						</div>
						<div class="shrink cell right no-margin">
							<input type="button" class="button button-blue" value="Add User" style="padding: 6px 15px;font-size:14px;line-height:1.25;" data-open="BlockUserAdd">
							<div class="reveal item-modal" id="BlockUserAdd" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
								<form action="" method="POST">
									<div class="grid-x grid-margin-x align-middle">
										<div class="auto cell no-margin">
											<div class="modal-title">Block User</div>
										</div>
										<div class="shrink cell no-margin">
											<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
										</div>
									</div>
									<div class="push-15"></div>
									<div>Please enter the username of the user you wish to block.</div>
									<div class="push-15"></div>
									<input type="text" name="block_user_username" class="normal-input">
									<div class="push-25"></div>
									<div align="center">
										<input type="submit" class="button button-blue store-button inline-block" value="Block User">
										<input type="button" data-close class="button button-grey store-button inline-block" value="Go back">
										<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="push-10"></div>
					<div class="container lg-padding border-r">
						<div id="blocked-users"></div>
					</div>
				</div>
				<div id="password" class="tabs-panel">
					<h5>Change Password</h5>
					<form action="" method="POST">
						<div class="container border-r lg-padding">
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-2 large-offset-1 cell text-right">
									<strong>Current Password</strong>
								</div>
								<div class="large-7 cell">
									<input type="password" name="current_password" class="normal-input">
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-2 large-offset-1 cell text-right">
									<strong>New Password</strong>
								</div>
								<div class="large-7 cell">
									<input type="password" name="new_password" class="normal-input">
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-2 large-offset-1 cell text-right">
									<strong>New Password (again)</strong>
								</div>
								<div class="large-7 cell">
									<input type="password" name="confirm_new_password" class="normal-input">
								</div>
							</div>
							<div class="push-25"></div>
							<div class="grid-x grid-margin-x align-middle">
								<div class="large-7 large-offset-3 cell">
									<input type="submit" name="password_save" class="button button-green" value="Save" style="margin:0 auto;">
									<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div id="billing" class="tabs-panel">
				<h5>Billing</h5>
				<div class="container border-r lg-padding">
					<form action="" method="POST">
						';

						if ($myU->VIP == 0) {

							echo '
							<div class="text-center">You have no active VIP subscriptions. <a href="'.$serverName.'/upgrade/" target="_blank">Click here</a> to upgrade!</div>
							';

						} else {

							switch ($myU->VIP) {
								case 1:
									$TypeName = 'Brick Builder';
									break;
								case 2:
									$TypeName = 'Planet Constructor';
									break;
								case 3:
									$TypeName = 'Master Architect';
									break;
							}

							echo '
							<div class="grid-x grid-margin-x align-middle settings-billing">
								<div class="large-6 cell text-center">
									<div class="content-title">CURRENT SUBSCRIPTION</div>
									<div class="content-text">'.$TypeName.'</div>
								</div>
								<div class="large-6 cell text-center">
									<div class="content-title">'; if ($myU->VIP_Recurring == 0) { echo 'EXPIRES'; } else { echo 'RENEWS'; } echo ' AT</div>
									<div class="content-text-small">'; if ($myU->VIP_Expires == -1) { echo 'Never - Lifetime'; } else { echo ''.date('m/d/Y g:iA', $myU->VIP_Expires).' CST'; } echo '</div>
									';

									if ($myU->VIP_Recurring == 1) {

										echo '
										<div style="height:5px;"></div>
										<input type="submit" value="Cancel" class="settings-button-blue" name="cancel_recurring">
										<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">
										';

									}

									echo '
								</div>
							</div>
							';

						}

						echo '
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
