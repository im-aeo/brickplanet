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

@auth
</div>
    <div class="large-3 cell">
        <form action="{{ route('forum.search') }}" method="GET">
            <input class="forum-input" type="text" name="search" placeholder="Search..." required>
        </form>
       <div class="push-15"></div>
				<div class="container border-r forum-topic-links">
              <a onclick="window.alert('In Maintenance.')" class="clearfix">
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell no-margin">
								<i class="material-icons" style="color:#F6B352;">bookmark</i>
								<span class="next-to-icon">Bookmarks</span>
							</div>
							<div class="shrink cell right no-margin">
								<span class="right">0</span>
							</div>
						</div>
					</a>
                  
              <a onclick="window.alert('In Maintenance.')" class="clearfix">
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell no-margin">
								<i class="material-icons" style="color:#30A9DE;">message</i>
								<span class="next-to-icon">My Posts</span>
							</div>
							<div class="shrink cell right no-margin">
								<span class="right">0</span>
							</div>
						</div>
					</a>
                   
              <a onclick="window.alert('In Maintenance.')" class="clearfix">
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell no-margin">
								<i class="material-icons" style="color:#9055A2;">drafts</i>
								<span class="next-to-icon">Drafts</span>
							</div>
							<div class="shrink cell right no-margin">
								<span class="right">0</span>
							</div>
						</div>
					</a>
				</div>
				<div class="push-25"></div>
                <h6><strong>Forum Level</strong></h6>
               <div class="container border-r md-padding text-center">
                 <div class="forum-level">{{ Auth::user()->forum_level }}</div>
                 <div class="forum-exp">{{ Auth::user()->forum_exp }}/{{ round(Auth::user()->forumLevelMaxExp()) }} EXP to level up</div>
            </div>
        </div>
    </div>
@endauth
