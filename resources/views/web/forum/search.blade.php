@extends('layouts.default', [
    'title' => 'Search Posts'
])

@section('css')
    <style>
        .thread {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .thread:not(:last-child) {
            border-bottom: 1px solid var(--divider_color);
        }

        .thread:hover {
            background: var(--section_bg_hover);
        }

        .thread .user-headshot {
            width: 50px;
            height: 50px;
            float: left;
            position: relative;
            overflow: hidden;
        }

        .thread .user-headshot img {
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        .thread .details {
            padding-left: 25px;
        }

        .thread .status {
            font-size: 11px;
            border-radius: 4px;
            margin-top: -2px;
            margin-right: 5px;
            padding: 0.5px 5px;
            font-weight: 600;
            display: inline-block;
        }

        .thread .status i {
            font-size: 10px;
            vertical-align: middle;
        }

        .thread .status i.fa-lock {
            margin-top: -1px;
        }
    </style>
@endsection

@section('content')
@if ($threads->count() == 0)
                <span>Post not found.</span>
            @else
<div class="grid-x grid-margin-x forum-top-links">
		<div class="auto cell">
			<a href="{{ route('forum.index') }}">Forum</a>
			&nbsp;&raquo;&nbsp;
			Search
		</div>
	</div>
<div class="grid-x grid-margin-x">
		<div class="@auth large-9 @else auto @endauth cell">
			<div class="container-header strong forum-header">
				<div class="grid-x grid-margin-x align-middle">
					<div class="large-7 medium-8 small-8 cell">
						Post
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
@foreach ($threads as $thread)
					
					<div class="topic-divider"></div>
					
					
					
					<div class="grid-x grid-margin-x align-middle forum-topic-container">
						<div class="large-7 medium-8 small-8 cell">
							<div class="grid-x grid-margin-x align-middle">
								<div class="shrink cell no-margin show-for-medium">
									<div style="border-radius:50%;width:48px;height:48px;background-image:url({{ $thread->creator->headshot() }});background-color:#1D1F24;background-size:cover;overflow:hidden;"></div>
								</div>
								<div class="auto cell topic-post-info">
									<div class="thread-content-title"><a href="{{ route('forum.thread', $thread->id) }}">{{ $thread->title }}</a>
									
									</div>
									<div class="grid-x grid-margin-x align-middle">
										<div class="shrink cell no-margin">
										@if ($thread->is_pinned)
											
											<span class="thread-pinned"><i class="material-icons" style="font-size:11px;">gavel</i> Pinned</span>
											
										@elseif ($thread->is_pinned)
											
											<span class="thread-locked"><i class="material-icons" style="font-size:11px;">lock</i> Locked</span>
											
									@endif
										
										</div>
										<div class="large-auto medium-auto small-12 cell no-margin">
											<div class="thread-content-post"><span class="show-for-medium">Posted by</span> <span><a  href="{{ route('users.profile', $thread->creator->username) }}" @if ($thread->creator->isStaff()) style="color:#ec2b1d;" @endif><strong>{{ $thread->creator->username }}</strong></a>&nbsp;-&nbsp;{{ $thread->updated_at->diffForHumans() }}</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="large-1 medium-2 small-2 cell text-center">
							{{ number_format($thread->replies(false)->count()) }}
						</div>
						<div class="large-1 medium-2 small-2 cell text-center">
							{{ number_format(0) }}
						</div>
						<div class="large-3 cell text-right show-for-large" style="word-break:break-word;">
                           @if ($thread->lastReply())
                          
							<a href="{{ route('forum.thread', $thread->id) }}" class="last-post-link">{{ $thread->title }}</a>
							<div class="last-post-link">by <a href="{{ route('users.profile', $thread->lastReply()->creator->username) }}" @if ($thread->creator->isStaff()) style="color:#ec2b1d;" @endif><strong>{{ $thread->lastReply()->creator->username }}</strong></a>- {{ $thread->lastReply()->updated_at->diffForHumans() }}</div>
                          @else
                          
                          N/A
                          
                          @endif
						</div>
					</div>
					@endforeach
			
			</div>
 {{ $threads->onEachSide(1)->links('vendor.pagination.aeo') }}
		
		@auth
@include('web.forum.search_bar')

@else
</div></div>
@endif
          
          @endif

@endsection