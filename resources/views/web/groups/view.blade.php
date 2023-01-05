@extends('layouts.default', [
    'title' => $group->name,
    'image' => $group->thumbnail()
])

@section('meta')
    <meta name="group-info" data-id="{{ $group->id }}" data-can-moderate-wall="{{ Auth::check() && Auth::user()->id == $group->owner->id }}">
@endsection

@section('css')
 <style>
        .error-message {
          background-color: transparent;
          color: red;
          font-size: 15px;
          padding: 0; 
          margin: 0;
        }
        
    </style>
@endsection

@section('js')
    <script src="{{ asset('js/group.js?v=6') }}"></script>
@endsection

@section('content')
	<div class="grid-x grid-margin-x view-group">
		<div class="large-3 medium-4 small-12 cell">
			<div class="container md-padding border-r" style="position:relative;">
				<img src="{{ $group->thumbnail() }}" class="group-logo">
			</div>
			<div class="group-name"><span>{{ $group->name }}</span></div>
			<div class="group-creator">Owner: <a href="{{ route('users.profile', $group->owner->username) }}">{{ $group->owner->username }}</a></div>

			@if(Auth::check() && Auth::user()->reachedGroupLimit())
				<div class="text-center"><strong>You have reached the limit of groups you can be apart of.</strong></div>
          
				<div class="push-10"></div>
			@elseif (Auth::check() && Auth::user()->id != $group->owner->id)
                        <form action="{{ route('groups.membership') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $group->id }}">

                            @if ($group->is_private && $isPending)
                                <button class="btn btn-block btn-secondary" disabled>Pending</button>
                            @elseif (!Auth::user()->isInGroup($group->id))
                                <button  class="button button-green groups-button" value="Join Group">Join</button>
                            @else
                                <button type="button" class="button button-red groups-button" value="Leave Group" data-open="LeaveModal">Leave Group</button>
                            @endif
                        </form>
                    @elseif( Auth::check() && $group->owner->id == Auth::user()->id)
                        <a href="{{ route('groups.manage', [$group->id, $group->slug()]) }}" class="button button-grey groups-button">Group Settings</a>
                        <a href="{{ route('creator_area.index', ['gid' => $group->id]) }}" class="button button-green groups-button">Create</a>
                    @endif

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
							<form action="{{ route('groups.membership') }}" method="POST">
                              @csrf
                              <input type="hidden" name="id" value="{{ $group->id }}">
                              
								<input type="submit" class="button button-red store-button inline-block" name="leave_group" value="Leave Group">
								<input type="button" data-close class="button button-grey store-button inline-block" value="Go back">
								
							</form>
						</div>
					</div>
				</div>
          
			<ul class="tabs view-group-tabs" data-tabs id="tabs">
				<li class="tabs-title is-active"><a href="#home" aria-selected="true">Home</a></li>
				<li class="tabs-title"><a href="#memberpan">Members</a></li>
				
					
				<li class="tabs-title"><a href="#store">Store</a></li>
			</ul>
			<div class="push-25"></div>
			<div class="container border-r md-padding">
				 @if (Auth::check() && Auth::user()->isInGroup($group->id))
					<div class="group-info-content">{{ Auth::user()->rankInGroup($group->id)->name }}</div>
					<div class="group-info-title">My Rank</div>
					<div class="push-15"></div>
					@endif
              
				<div class="group-info-content">{{ number_format($group->members()->count()) }}</div>
				<div class="group-info-title">
              @if($group->members()->count() == 1)   
              Member
              @else
              Members
              @endif
              </div>
				@if ($group->is_vault_viewable)
              
					<div class="push-15"></div>
					<div class="group-info-content coins-text" style="color:#f0be1d;">{{ number_format($group->vault) }} Bits</div>
					<div class="group-info-title">Group Vault</div>
			@endif

			
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
						@if (Auth::check() && Auth::user()->isInGroup($group->id))
							<div>
								<span class="group-settings" style="cursor:pointer;" data-toggle="group-{{ $group->id }}-dropdown"><i class="material-icons">more_vert</i></span>
								<div class="dropdown-pane creator-area-dropdown wall-post-header" id="group-{{ $group->id }}-dropdown" data-dropdown data-hover="false" data-hover-pane="true">
                                  
						<form action="{{ route('groups.set_primary') }}" method="POST" style="display:inline-block;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $group->id }}">
                            <ul>
								<li>
									<span>
                                      <button type="submit" name="favorite_group" style="color:#ffffff;cursor:pointer;" title="{{ (Auth::user()->primary_group_id == $group->id) ? 'Unfavorite' : 'Favorite' }} this group">{{ (Auth::user()->primary_group_id == $group->id) ? 'Unfavorite' : 'Favorite' }} Group</button>
									</span>
								</li>
							</ul>
						<div class="creator-area-dropdown-divider"></div> 
                        </form>
                                  
								<ul>
                                  <a href="{{ route('report.index', ['group', $group->id]) }}">
                                  <li><button style="color:#ffffff;cursor:pointer;">Report Abuse</button></li>
                                  </a>	
								</ul>
								</div>
							</div>
@endif
						</div>
					</div>
					<div class="container border-r md-padding">
					{!! (!empty($group->description)) ? nl2br(e($group->description)) : 'This group does not have a description.' !!}
					</div>
					@if (Auth::check() && Auth::user()->isInGroup($group->id))
						<div class="push-25"></div>
						<div class="container md-padding border-r">
						<h5>Group Wall</h5>
							<form id="wallPost">
                              @csrf
								<textarea class="normal-input wall-textarea" name="body"></textarea>
								<div class="wall-options clearfix">
                                  <div class="float-left">
                                   <p class="error-message" id="wall_errors"></p>
                                  </div>
									<div class="float-right">
										<input type="submit" class="button button-green" value="Post">
									</div>
								</div>
							</form>
							<div class="push-15"></div>
							<div id="wall"></div>
                  </div>
              @endif
                          
				<div id="memberpan" class="tabs-panel">
					<div class="container border-r md-padding">
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell">
								<h5>Members</h5>
							</div>
							<div class="shrink cell right">
								<select class="normal-input" onchange="switchRank(this.value)">
								<option value="'.$key.'">s</option>
								</select>
							</div>
						</div>
						<div class="push-10"></div>
						<div id="members"></div>
					</div>
				</div>
				
					<div id="divisions" class="tabs-panel '; if ($gG->IsMember == 0 && $gG->NonMemberTab == 3 || $gG->IsMember == 1 && $gG->MemberTab == 3) { echo 'is-active'; } echo '">
						<h5>Divisions</h5>
						<div class="container border-r md-padding">
							<div id="DivisionsDiv"></div>
						</div>
					</div>
					
				<div id="store" class="tabs-panel '; if ($gG->IsMember == 0 && $gG->NonMemberTab == 4 || $gG->IsMember == 1 && $gG->MemberTab == 4) { echo 'is-active'; } echo '">
					<h5>Store</h5>
					<div class="container border-r md-padding">
						<div id="StoreDiv"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection