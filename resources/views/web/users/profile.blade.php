<!--
MIT License

Copyright (c) 2022 Aeo

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
    'title' => "{$user->username}'s Profile",
    'image' => $user->headshot()
])

@section('meta')
    <meta name="item-types-with-padding" content="{{ json_encode(config('site.item_thumbnails_with_padding')) }}">
    <meta name="item-type-padding-amount" content="{{ itemTypePadding('default') }}">
    <meta name="user-info" data-id="{{ $user->id }}" data-inventory-public="{{ $user->setting->public_inventory }}">
@endsection

@section('css')
    <style>
        .description {
            height: 225px;
            overflow-y: auto;
        }

        @media only screen and (max-width: 768px) {
            .description {
                height: auto;
                max-height: 225px;
            }
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('js/profile.js?v=4') }}"></script>
@endsection

@section('content')
<div class="col-10-12 push-1-12">
        
@if ($user->status())
<div class="grid-x grid-margin-x">
			<div class="profile-speechBubble" style="width:auto;max-width:100%;">
				<div class="user-profile-status">
					<i class="fa fa-quote-left" style="color:#595E6E;"></i>
					<font style="padding:10px;font-weight:600;">{{ $user->status() }}</font>
                  <i class="fa fa-quote-right" style="color:#595E6E;"></i>
				</div>
			</div>
		</div>
@endif        

<div class="show-for-small-only">	
	<div class="grid-x grid-margin-x align-middle">
		<div class="shrink cell no-margin">
			<div class="profile-username">
				{{ $user->username }}
			</div>
		</div>
		<div class="auto cell no-margin">
		
			<span class="profile-{{ ($user->online()) ? 'online' : 'offline' }}">{{ ($user->online()) ? 'ONLINE' : 'OFFLINE' }}</span>
			
		</div>
		<div class="shrink show-for-medium cell no-margin right">
			<div class="push-15 hide-for-large"></div>
			<div class="container border-r profile-info-box">
				<div class="number-stat">
					<span>0</span>
					Game Visits
				</div>
				<div class="number-stat">
					<span>{{ number_format($user->friends()->count()) }}</span>
					Friends
				</div>
				<div class="number-stat">
                  <span>{{ $user->views }}</span>
                  @if($user->views == 1)
                  View
                  @else
                  Views
                  @endif
				</div>
			</div>
		</div>
	</div>
	</div>
	
	<div class="grid-x grid-margin-x">
		<div class="profile-left medium-5 cell">
			<div class="container md-padding @if($user->hasPrimaryGroup()) avatar-container-br @else border-r @endif">
			
				<img src="{{ $user->thumbnail() }}" class="avatar-profile">
              
              @if($user->username == 'aeo')
             <span class="thread-pinned" style="padding: 6px 12px;background: #c72020 !important;"><i class="material-icons" style="font-size: 15px;">sort</i>Code Creator</span>
              @endif
          </div>
          @if ($user->hasPrimaryGroup())
          <div class="user-profile-main-group">
					<div class="grid-x grid-margin-x align-middle">
						<div class="shrink cell no-margin">
							<div class="up-main-group-logo" style="background:url({{ $user->primaryGroup->thumbnail() }});background-size:cover;">
							</div>
						</div>
						<div class="shrink cell no-margin">
							<a href="{{ route('groups.view', [$user->primaryGroup->id, $user->primaryGroup->slug()]) }}" class="up-main-group-name">{{ $user->primaryGroup->name }}</a>
						</div>
					</div>
		  </div>
          @endif
          
			<div class="push-25"></div>
			@if ($user->isBanned())
            <div class="container border-r sm-padding text-center" style="background-color:#711c1c;">
						<div class="profile-info-line">
							<span><i class="material-icons" style="color:#f5f5f5;line-height:1;">info_outline</i></span><span style="color:#f5f5f5;"><strong>This player has been suspended.</strong></span>
						</div>
					</div>
					<div class="push-15"></div>
        @endif
          @if (Auth::check() && $user->id != Auth::user()->id)
                                <div class="row mt-3">
                                    @if ($user->setting->accepts_messages)
                                        <div class="col">
                                            <a href="{{ route('account.inbox.new', ['message', $user->username]) }}" class="button button-blue text-center"><i class="material-icons">message</i><span>Open Chat</span></a>
                                        </div>
                                  <div class="push-15"></div>
                                    @endif

                                    @if ($areFriends || $isPending || $user->setting->accepts_friends)
                                        <div class="col">
                                            @if ($areFriends)
                                          
                                                <form id="friend-status" action="{{ route('account.friends.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <input type="hidden" name="action" value="remove">
                                                    <a class="button button-red text-center" onclick="document.getElementById('friend-status').submit();">
<i class="material-icons">group_remove</i><span>Remove Friend</span></a>
                                                </form>
                                          <div class="push-15"></div>
                                            @elseif ($isPending)
                                                <form id="friend-status" action="{{ route('account.friends.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <input type="hidden" name="action" value="remove">
                                                    <a class="button button-grey text-center" onclick="document.getElementById('friend-status').submit();" disabled>
<i class="material-icons">watch_later</i><span>Friend Request Pending</span></a>
                                          <div class="push-15"></div>
                                            @elseif ($user->setting->accepts_friends)
                                                <form id="friend-status" action="{{ route('account.friends.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <input type="hidden" name="action" value="send">
                                                    <a id="friend-status" class="button button-green text-center"onclick="document.getElementById('friend-status').submit();">
<i class="material-icons">add_box</i><span>Add As Friend</span></a>
                                                </form>
                                          <div class="push-15"></div>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($user->setting->accepts_trades && !$user->isBanned())
                                        <div class="col">
                                            <a class="button button-grey text-center" href="{{ route('account.trades.send', $user->username) }}" class="btn btn-block btn-warning"><i class="material-icons">swap_horiz</i><span>Trade User</span></a>
                                        </div>
                                  <div class="push-15"></div>
                                    @endif
                                </div>
                            @endif

                            @if (Auth::check() && Auth::user()->isStaff() && Auth::user()->staff('can_view_user_info'))
          <a class="button button-red text-center"
             href="{{ route('admin.users.view', $user->id) }}" target="_blank">
         
            
            <i class="material-icons">gavel</i> View in Panel</a>
                            @endif
			<div class="push-15"></div>
      
          <h5>About Me</h5>
			<div class="container border-r md-padding">
				
					<span> {!! (!empty($user->description)) ? nl2br(e($user->description)) : '<div class="text-muted">This user does not have an About Me.</div>' !!}</span>
			</div>
          
          <div class="push-25"></div>
			<h5>Statistics</h5>
			<div class="container border-r md-padding">
              @if($user->hasMembership())
				<div class="profile-info-line">
						<i class="material-icons" style="color:{{ config('site.membership_bg_color') }}">
                        verified
                        </i>
						<span style="color:{{ config('site.membership_bg_color') }};font-weight:700;">{{ config('site.membership_name') }} Membership</span>
					</div>
              @endif
				<div class="profile-info-line">
					<i class="material-icons">access_time</i>
					<span>Last seen {{ ($user->online()) ? 'Now' : $user->updated_at->diffForHumans() }}</span>
				</div>
				<div class="profile-info-line">
					<i class="material-icons">date_range</i>
					<span>Joined {{ $user->created_at->format('m/d/Y') }}</span>
				</div>
				<div class="profile-info-line">
					<i class="material-icons">forum</i>
					<span>{{ $user->forumPostCount() }} forum posts</span>
				</div>
			</div>
			<div class="push-25"></div>
			<div class="grid-x grid-margin-x align-middle">
				<div class="auto cell no-margin">
					<h5 style="margin:0;">Friends</h5>
				</div>
				<div class="shrink cell right no-margin">
					<a href="{{ route('users.friends', $user->username) }}" class="button button-grey" style="padding: 3px 15px;font-size:13px;line-height:1.25;">View All</a>
				</div>
			</div>
			<div class="push-10"></div>
         @if( $friends->count() > 0)             
             <div class="container border-r">
					<div class="grid-x grid-margin-x align-middle">                     
			 @foreach($friends as $friend)
                                  
                         <div class="large-4 medium-4 small-4 cell profile-friend text-center">
							<a href="{{ route('users.profile', $friend->username) }}">
								<div class="profile-friend-preview relative" style="background-image:url({{ $friend->headshot() }});background-size:cover;">
								<span class="user-friend-online-status" style="background:#{!! ($friend->online()) ? '56A902' : 'AAAAAA' !!};"></span>
								</div>
							</a>
							<a href="{{ route('users.profile', $friend->username) }}" title="{{ $friend->username }}">{{ $friend->username }}</a>
						</div>
               @endforeach
               </div>
               <div class="push-15"></div>
             </div>
         @else                    
				<div class="container border-r md-padding text-center">
					<i class="material-icons user-friends-icon">sentiment_dissatisfied</i>
					<div class="user-friends-msg"><strong>{{ $user->username }}</strong> hasn't added any friends yet.</div>
                  @if (Auth::check() || $areFriends || $isPending || $user->setting->accepts_friends)
					<div class="user-friends-add"><a onclick="document.getElementById('friend-status').submit();">Send a friend request</a></div>
                 
				</div>
		    @endif
         @endif
			<div class="push-25"></div>
			<div class="grid-x grid-margin-x align-middle">
				<div class="auto cell no-margin">
					<h5 style="margin:0;">Groups</h5>
				</div>
				<div class="shrink cell right no-margin">
					<a href="/user/groups/" class="button button-grey" style="padding: 3px 15px;font-size:13px;line-height:1.25;">View All</a>
				</div>
			</div>
			<div class="push-10"></div>
           <div class="container border-r md-padding">                       
           @if($groups->count() > 0)
            @foreach ($groups as $group) 
           <div class="grid-x grid-margin-x align-middle">
							<div class="shrink cell">
								<a href="{{ route('groups.view', [$group->id, $group->slug()]) }}">
									<div class="profile-friend-preview relative" style="background:url({{ $group->thumbnail() }});background-size:cover;">

						@if ($group->is_verified == 1)                                      
                        <i class="material-icons" style="color:#00ACEE;" style="height:20px;width:20px;position:absolute;bottom:0;right:0;" title="This group is verified">
                        verified
                        </i>
                         @endif
									</div>
								</a>
							</div>
							<div class="auto cell">
								<a href="{{ route('groups.view', [$group->id, $group->slug()]) }}" style="color:#E3E3E3;font-weight:600;word-break:break-word;">
									{{ $group->name }}
								</a>
							</div>
						</div>  
             <div class="profile-groups-divider"></div>
            @endforeach  
           @else
           <div style="margin:0 auto;text-align:center;"><i class="material-icons" style="font-size:38px;">sentiment_dissatisfied</i></div>
					<div style="font-size:13px;text-align:center;"><strong>{{ $user->username }}</strong> is not a member of any groups yet.</div>
           @endif  
			</div>
			<div class="push-25"></div>
		</div>
		<div class="profile-right medium-7 cell">
			<div class="show-for-medium">
				
	<div class="grid-x grid-margin-x align-middle">
		<div class="shrink cell no-margin">
			<div class="profile-username">
				{{ $user->username }}
			</div>
		</div>
		<div class="auto cell no-margin">
		
			<span class="profile-{{ ($user->online()) ? 'online' : 'offline' }}">{{ ($user->online()) ? 'ONLINE' : 'OFFLINE' }}</span>
			
		</div>
		<div class="shrink show-for-medium cell no-margin right">
			<div class="push-15 hide-for-large"></div>
			<div class="container border-r profile-info-box">
				<div class="number-stat">
					<span>0</span>
					Game Visits
				</div>
				<div class="number-stat">
					<span>{{ number_format($user->friends()->count()) }}</span>
					Friends
				</div>
				<div class="number-stat">
                  <span>{{ $user->views }}</span>
                  @if($user->views == 1)
                  View
                  @else
                  Views
                  @endif
				</div>
			</div>
		</div>
	</div>
	<div class="push-25 hide-for-medium"></div>
	
			</div>
			<div class="push-25"></div>
			<style>
			.achievement-image-profile {
				vertical-align: top;
				width: 70px;
				height: 70px;
				display: inline-block;
				background-size: 70px 70px;
			}

			.inline-block {
				display: inline-block;
			}

			.panel {
				margin-bottom: 7px;
				padding: 10px;
				border-radius: 5px;
				background: #1E2024;
			}
			</style>
          @if (!empty($user->badges()))
			<h5>Achievements</h5>
				<div class="container border-r md-padding">
					<div class="grid-x grid-margin-x align-middle">
                      @foreach ($user->badges() as $badge)
                      <div class="large-2 medium-2 small-4 cell text-center">
						<div class="panel text-left inline-block achievement-card">
							<span data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover="false" title="{{ $badge->name }}">
								<a href="{{ route('badges.index') }}"><div class="achievement-image-profile" style="background-image:url({{ $badge->image }});"></div></a>
							</span>
						</div>
					</div>
                      @endforeach
                      					</div>
				</div>
				<div class="push-25"></div>
             @endif
			<ul class="tabs profile-tabs" data-tabs id="tabs">
				<li class="tabs-title is-active"><a href="#wall" aria-selected="true">WALL</a></li>
				<li class="tabs-title"><a href="#games">GAMES</a></li>
				<li><a href="{{ route('users.items', [$user->username]) }}" class="no-right-border">BACKPACK</a></li>
			</ul>
			<div class="tabs-content" data-tabs-content="tabs">
				<div id="wall" class="tabs-panel is-active">
					<div class="container border-wh md-padding">
                      <script>
								var wall;
								window.onload = function() {
									wall = document.getElementById("wall-textarea");
								}

								function placeCaretAtEnd(el) {
									el.focus();
									if (typeof window.getSelection != "undefined"
											&& typeof document.createRange != "undefined") {
										var range = document.createRange();
										range.selectNodeContents(el);
										range.collapse(false);
										var sel = window.getSelection();
										sel.removeAllRanges();
										sel.addRange(range);
									} else if (typeof document.body.createTextRange != "undefined") {
										var textRange = document.body.createTextRange();
										textRange.moveToElementText(el);
										textRange.collapse(false);
										textRange.select();
									}
								}

								function copyTextarea() {
									//var decoded = $("<div/>").html(wall.innerHTML).text();
									wall.innerHTML.replace("<div>", "");
									wall.innerHTML.replace("</div>", "");
									document.getElementById("wall-hidden").value = wall.innerHTML;
									console.log(document.getElementById("wall-hidden").value);
								}

								function addToTextBox(name, description) {
									wall.innerHTML += `<img src="https://twemoji.twitter.com/2/72x72/` + name + `.png" style="width:16px;height:16px;">`;
									wall.focus();
									placeCaretAtEnd(wall);
								}
							</script>
							<h5>User Wall</h5>
							<a name="UserWall"></a>
							<form action="" method="POST" onsubmit="return copyTextarea()">
                             @csrf
								<input type="hidden" name="csrf_token" value="">
								<input type="hidden" name="wall" id="wall-hidden">
								<div class="normal-input wall-textarea" id="wall-textarea" @guest style="pointer-events:none;opacity:0.4;" @endguest contenteditable="true" autofocus onfocus="this.value = this.value;"></div>
								<div class="wall-options">
									<div class="grid-x grid-margin-x align-middle">
										<div class="auto cell no-margin">
											<div class="wall-option" data-toggle="EmojiDropdown" aria-controls="EmojiDropdown" onclick="handleEmojiDropDown()"><i class="material-icons">sentiment_satisfied</i></div>
											<div id="EmojiDropdown" class="emoji-dropdown" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;">
												<input type="text" class="normal-input emoji-search" oninput="functionSearch(this.value)" placeholder="Search">
												<div id="emojis-body" class="emojis-body"></div>
											</div>
										</div>
										<div class="shrink cell no-margin right">
											<input type="submit" value="Post" class="button button-green" @guest disabled @endguest>
										</div>
									</div>
								</div>
							</form>
                  @foreach($posts as $post)
                      <div class="wall-post">
								<div class="wall-post-header">
									<div class="grid-x grid-margin-x align-middle">
										<div class="shrink cell no-margin">
											<a href="'.$serverName.'/users/'.$gW->Username.'/"><div style="background-image:url({{ $post->user->headshot() }});background-size:cover;" class="wall-post-avatar"></div></a>
										</div>
										<div class="auto cell no-margin">
											<a href="'.$serverName.'/users/'.$gW->Username.'/" class="wall-post-username">{{ $post->user->username }}</a>
											w
										</div>
										<div class="shrink cell no-margin right">
											<span class="wall-post-time">{{ $post->created_at->format('m/d/Y') }}</span>
											@auth
												<span class="wall-settings" data-toggle="wall-'.$gW->ID.'-dropdown"><i class="material-icons">settings</i></span>
												<div class="dropdown-pane creator-area-dropdown" id="wall-'.$gW->ID.'-dropdown" data-dropdown data-hover="true" data-hover-pane="true">
												';

												if ($AUTH && $gU->ID == $myU->ID || $AUTH && $myU->Admin > 0) {

													echo '
													<ul>
														<li><form action="" method="POST"><button type="submit" name="delete_wall">Delete Post</button><input type="hidden" name="wall_id" value="'.$gW->ID.'"><input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'"></form></li>
													</ul>
													<div class="creator-area-dropdown-divider"></div>
													';

												}

												echo '
												<ul>
													<li><form action="" method="POST"><button type="submit" name="report_wall">Report Post</button><input type="hidden" name="wall_id" value="'.$gW->ID.'"><input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'"></form></li>
												</ul>
												</div>
												@endauth
										</div>
									</div>
								</div>
								<div class="wall-post-main">
									$post->body
								</div>
							</div>
						</div>
                  @endforeach
						
				</div>
				<div id="games" class="tabs-panel">
						<div class="container md-padding text-center">
							<div class="user-games-icon"><i class="material-icons">games</i></div>
							<div class="user-games-msg">This user does not have any games.</div>
						</div>
						
				</div>
			</div>
		</div>
	</div>
@endsection
