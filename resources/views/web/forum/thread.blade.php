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
    'title' => $thread->title,
    'image' => $thread->creator->headshot()
])

@section('css')
    <style>
        img.user-headshot {
            background: var(--section_bg);
            border-radius: 6px;
            width: 50px;
        }

        .primary-group {
            background: var(--section_bg_inside);
            font-weight: 600;
            border-radius: 4px;
            padding: 3px 10px;
        }

        .primary-group a {
            color: inherit;
            font-size: 12px;
        }

        .primary-group .rank {
            font-size: 11px;
            margin-top: -2px;
            margin-bottom: 5px;
        }

        .primary-group img {
            border-radius: 6px;
            max-width: 250%;
        }

        @media only screen and (max-width: 768px) {
            .primary-group img {
                max-width: 35%;
                margin-top: 5px;
            }
        }
    </style>
@endsection

@section('content')
    @if ($thread->is_deleted)
        <div class="alert bg-danger text-white text-center">This thread is deleted.</div>
    @endif
    <div class="grid-x grid-margin-x forum-top-links">
		<div class="large-10 large-offset-1 cell">
          
        <a href="{{ route('forum.index') }}">Forum</a>
          	&nbsp;&raquo;&nbsp;
        <a href="{{ route('forum.topic', [$thread->topic->id, $thread->topic->slug()]) }}">{{ $thread->topic->name }}</a>
          &nbsp;&raquo;&nbsp;
        {{ $thread->title }}
    </div>
</div>
    <div class="grid-x grid-margin-x">
			<div class="large-10 large-offset-1 cell">
				<div class="container md-padding border-r" style="word-break:break-word;">
				<div class="grid-x grid-margin-x align-middle forum-thread-title">
					<div class="auto cell no-margin">
                      
                @if ($thread->is_pinned) <i class="material-icons">pin_drop</i> @endif
                @if ($thread->is_locked) <i class="material-icons">lock</i> @endif
                <span class="title">{{ $thread->title }}</span>
            </div>
<div class="shrink cell right no-margin">
  @if (!Auth::check() || (Auth::check() && (!$thread->is_locked || Auth::user()->isStaff() && $thread->is_locked)))
                <a href="{{ route('forum.new', ['reply', $thread->id]) }}" class="button button-green"><i class="material-icons">reply</i><span>Reply</span></a>
            @else
                
            @endif
                  </div>
                  </div>
            @if ($thread->replies()->currentPage() == 1)
                <div class="forum-thread-header">
					<div class="grid-x grid-margin-x align-middle">
						<div class="thread-header-adjustment large-shrink medium-shrink small-4 cell">
                          <div class="user-{{ ($thread->creator->online()) ? 'online' : 'offline' }}"></div>
                                    <a href="{{ route('users.profile', $thread->creator->username) }}" style="color:inherit;">{{ $thread->creator->username }}</a>
                                    @if ($thread->creator->is_verified)
                                        <i class="fas fa-shield-check text-success ml-1" style="font-size:13px;" title="This user is verified." data-toggle="tooltip"></i>
                                    @endif
                      </div>
                      <div class="auto cell">
							<span class="show-for-medium">Posted </span><span>
                        {{ $thread->created_at->diffForHumans() }}
                        </span>
                      </div>
                      <div class="shrink cell right">
                        @auth
                                    @if ($thread->creator->id != Auth::user()->id && !$thread->creator->isStaff())
                                        <a href="{{ route('report.index', ['forum-thread', $thread->id]) }}" class="report-abuse-forum-icon"><i class="material-icons" class="report-abuse-forum-icon">flag</i></a>
                                    @endif
                                @endauth
                        
                        @if (Auth::check() && Auth::user()->isStaff())
                                    @if (
                                        Auth::user()->staff('can_delete_forum_posts') ||
                                        Auth::user()->staff('can_edit_forum_posts') ||
                                        Auth::user()->staff('can_pin_forum_posts') ||
                                        Auth::user()->staff('can_lock_forum_posts')
                                    ) {!! (!$thread->creator->forum_signature) ? '' : '' !!}  @endif

                                    @if (Auth::user()->staff('can_delete_forum_posts'))
                                        <a href="{{ route('forum.moderate', ['thread', 'delete', $thread->id]) }}" class="quote-a"><i class="material-icons">delete</i></a>
                                    @endif

                                    @if (Auth::user()->staff('can_edit_forum_posts'))
                                        <a href="{{ route('forum.edit', ['thread', $thread->id]) }}" class="quote-a"><i class="material-icons">border_color</i></a>
                                    @endif

                                    @if (Auth::user()->staff('can_pin_forum_posts'))
                                        <a href="{{ route('forum.moderate', ['thread', 'pin', $thread->id]) }}" class="quote-a"><i class="material-icons">pin_drop</i></a>
                                    @endif

                                    @if (Auth::user()->staff('can_lock_forum_posts'))
                                        <a href="{{ route('forum.moderate', ['thread', 'lock', $thread->id]) }}" class="quote-a"><i class="material-icons">lock</i></a>
                                    @endif
                                @endif
                        
  
                            </div>
                        </div>
                    </div>
                    <div class="forum-content-wrapper">
					<div class="grid-x grid-margin-x">
						<div class="large-shrink medium-shrink small-4 cell text-center">
                                <a href="{{ route('users.profile', $thread->creator->username) }}">
                                    <img width="175" height="175" src="{{ $thread->creator->thumbnail() }}">
                                </a>

                                

                                @if ($thread->creator->hasPrimaryGroup())
                                    <div class="forum-user-favorite-group">
									<div class="grid-x grid-margin-x align-middle">
                                      
										<div class="shrink cell no-margin">
                                          
                                                <a href="{{ route('groups.view', [$thread->creator->primaryGroup->id, $thread->creator->primaryGroup->slug()]) }}">
                                                  
                                                    <div class="forum-user-favorite-group-logo"  style="background:url('{{ $thread->creator->primaryGroup->thumbnail() }}');background-size:cover;"></div></a>
                                      </div>
                                            <div class="auto cell no-margin forum-user-favorite-group-name">
                                                    <a href="{{ route('groups.view', [$thread->creator->primaryGroup->id, $thread->creator->primaryGroup->slug()]) }}">{{ $thread->creator->primaryGroup->name }}</a>
                                              </div>
                                        </div>
                                    </div>
                                              @endif
                                                    
                                            
                          
                                @if ($thread->creator->isStaff())
                                    <div class="forum-admin">
									<i class="fa fa-gavel show-for-medium"></i><span>Admin</span><span class="show-for-medium">istrator</span>
								</div>
                                @elseif($thread->creator->hasMembership())
                                    <div class="card-planet-constructor" style="color:{{ config('site.membership_color') }};background:{{ config('site.membership_bg_color') }};"><div class="card-image"><span>{{ config('site.membership_name') }}</span></div>
                                @endif
<div class="thread-user-stats show-for-medium">
								<div class="stat-left">Join Date:</div>
								<div class="stat-right">{{ $thread->creator->created_at->format('d/m/Y') }}</div>
							</div>
                          <div class="thread-user-stats">
								<div class="stat-left">Posts:</div>
                            
                                    <div class="stat-right">{{ number_format($thread->creator->forumPostCount()) }}</div>
							</div>
                                <div class="thread-user-stats">
								<div class="stat-left">Level:</div>
                                   
                                    <div class="stat-right">{{ $thread->creator->forum_level }}</div>
							</div>
						</div>
						<div class="large-auto medium-auto small-8 cell">
							<div class="forum-main-content">
								<div class="forum-thread-body">
                                <div>{!! nl2br(e($thread->body)) !!}</div>
                                  @if ($thread->creator->forum_signature)
                                    <div class="group-divider"></div>
                                    <div>{{ $thread->creator->forum_signature }}</div>
                                @endif
                                  
                              </div>
                          </div>
<div class="grid-x grid-margin-x align-middle thread-content-info">
								<div class="large-auto medium-6 small-12 cell">
									<div class="thread-content-info-part">
                                      
									<span>0 LIKES</span>
									</div>
									<div class="thread-content-info-part show-for-medium">
										<i class="material-icons">remove_red_eye</i>
										<span>
                                        {{ $thread->views }}
                                        @if($thread->views == 0)
                                        VIEW
                                        @else
                                        VIEWS
                                        @endif
                                        </span>
									</div>
									<div class="thread-content-info-part">
										<i class="material-icons">forum</i>
										<span>
                                        {{ $thread->replies()->count() }} 
                                        @if($thread->replies()->count() == 1)
                                        REPLY
                                        @else
                                        REPLIES
                                        @endif
                                        </span>
									</div>
								</div>
                               

                                
                            </div>
                        </div>
                    </div>
                
            @endif

            @foreach ($thread->replies() as $reply)
                <div class="forum-thread-header">
					<div class="grid-x grid-margin-x align-middle">
						<div class="thread-header-adjustment large-shrink medium-shrink small-4 cell">
                          <div class="user-{{ ($reply->creator->online()) ? 'online' : 'offline' }}"></div>
                                    <a href="{{ route('users.profile', $reply->creator->username) }}" style="color:inherit;">{{ $reply->creator->username }}</a>
                                    @if ($reply->creator->is_verified)
                                        <i class="fas fa-shield-check text-success ml-1" style="font-size:13px;" title="This user is verified." data-toggle="tooltip"></i>
                                    @endif
                      </div>
                      <div class="auto cell">
							<span class="show-for-medium">Posted </span><span>
                        {{ $reply->created_at->diffForHumans() }}
                        </span>
                      </div>
                      <div class="shrink cell right">
                        @auth
                                    
                                        <a href="{{ route('forum.new', ['quote', $reply->id]) }}" class="quote-a"><i class="material-icons">format_quote</i></a>
                                    @if ($reply->creator->id != Auth::user()->id && !$reply->creator->isStaff())
                                        <a href="{{ route('report.index', ['forum-reply', $reply->id]) }}" class="report-abuse-forum-icon"><i class="material-icons" class="report-abuse-forum-icon">flag</i></a>
                                    @endif
                                @endauth
                        
                        @if (Auth::check() && Auth::user()->isStaff())
                                    @if (
                                        Auth::user()->staff('can_delete_forum_posts') ||
                                        Auth::user()->staff('can_edit_forum_posts') ||
                                        Auth::user()->staff('can_pin_forum_posts') ||
                                        Auth::user()->staff('can_lock_forum_posts')
                                    ) {!! (!$reply->creator->forum_signature) ? '' : '' !!}  @endif

                                    

                                    @if (Auth::user()->staff('can_edit_forum_posts'))
                                        <a href="{{ route('forum.edit', ['reply', $reply->id]) }}" class="quote-a"><i class="material-icons">border_color</i></a>
                                    @endif

                                    
                                @endif
                        
  
                            </div>
                        </div>
                    </div>
                    <div class="forum-content-wrapper">
					<div class="grid-x grid-margin-x">
						<div class="large-shrink medium-shrink small-4 cell text-center">
                                <a href="{{ route('users.profile', $reply->creator->username) }}">
                                    <img width="175" height="175" src="{{ $reply->creator->thumbnail() }}">
                                </a>

                                

                                @if ($reply->creator->hasPrimaryGroup())
                                    <div class="forum-user-favorite-group">
									<div class="grid-x grid-margin-x align-middle">
                                      
										<div class="shrink cell no-margin">
                                          
                                                <a href="{{ route('groups.view', [$reply->creator->primaryGroup->id, $reply->creator->primaryGroup->slug()]) }}">
                                                  
                                                    <div class="forum-user-favorite-group-logo"  style="background:url('{{ $reply->creator->primaryGroup->thumbnail() }}');background-size:cover;"></div></a>
                                      </div>
                                            <div class="auto cell no-margin forum-user-favorite-group-name">
                                                    <a href="{{ route('groups.view', [$reply->creator->primaryGroup->id, $reply->creator->primaryGroup->slug()]) }}">{{ $reply->creator->primaryGroup->name }}</a>
                                              </div>
                                        </div>
                                    </div>
                                              @endif
                                                    
                                            
                          
                                @if ($reply->creator->isStaff())
                                    <div class="forum-admin">
									<i class="fa fa-gavel show-for-medium"></i><span>Admin</span><span class="show-for-medium">istrator</span>
								</div>
                                @elseif($reply->creator->hasMembership())
                                    <div class="card-planet-constructor" style="color:{{ config('site.membership_color') }};background:{{ config('site.membership_bg_color') }};"><div class="card-image"><span>{{ config('site.membership_name') }}</span></div>
                                @endif
<div class="thread-user-stats show-for-medium">
								<div class="stat-left">Join Date:</div>
								<div class="stat-right">{{ $reply->creator->created_at->format('d/m/Y') }}</div>
							</div>
                          <div class="thread-user-stats">
								<div class="stat-left">Posts:</div>
                            
                                    <div class="stat-right">{{ number_format($reply->creator->forumPostCount()) }}</div>
							</div>
                                <div class="thread-user-stats">
								<div class="stat-left">Level:</div>
                                   
                                    <div class="stat-right">{{ $reply->creator->forum_level }}</div>
							</div>
						</div>
						<div class="large-auto medium-auto small-8 cell">
							<div class="forum-main-content">
                              @if ($reply->quote_id && (!$reply->quote->is_deleted || (Auth::check() && Auth::user()->isStaff())))
                              <div class="forum-quote">
											<div class="forum-quote-info">Originally posted by <a href="{{ route('users.profile', $reply->quote->creator->username) }}">{{ $reply->quote->creator->username }}</a>&nbsp;-&nbsp;{{ $reply->quote->created_at->diffForHumans() }}</div>
											<div class="forum-quote-post"><div class="forum-thread-body">{!! nl2br(e($reply->quote->body)) !!}</div></div>
										</div>
										<div class="push-15"></div>
                              @endif
								<div class="forum-thread-body">
                                <div>{!! nl2br(e($reply->body)) !!}</div>
                                  @if ($reply->creator->forum_signature)
                                    <div class="group-divider"></div>
                                    <div>{{ $reply->creator->forum_signature }}</div>
                                @endif
                                  
                              </div>
                          </div>

                               

                                
                            </div>
                        </div>
                    </div>
                
            @endforeach
                  </div>
              </div>
        </div>
    </div>
</div>
    {{ $thread->replies()->onEachSide(1)->links('vendor.pagination.aeo') }}
@endsection
