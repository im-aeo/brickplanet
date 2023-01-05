/**
 * MIT License
 *
 * Copyright (c) 2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

var id;
var canModerateWall;

$(() => {
    const meta = 'meta[name="group-info"]';
    id = parseInt($(meta).attr('data-id'));
    canModerateWall = parseInt($(meta).attr('data-can-moderate-wall'));

    getMembers(1, 1);
    getItems(1);
    getWallPosts(1);

    $('#membersTab select').change(function() {
        getMembers($(this).val(), 1);
    });

    $('#wallPost').submit(function(event) {
        event.preventDefault();

        var body = $(this).find('textarea[name="body"]').val();

        $.post('/api/groups/wall-post', { _token, id, body }).done((data) => {
            $('#wallPostError').html('');

            if (typeof data.error !== 'undefined') {
                $('#wallPostError').html(data.error);
            } else {
                $('#wallPostError').html('');
                $(this).find('textarea[name="body"]').val('');
                getWallPosts(1);
            }
        }).fail(() => $('#wallPostError').html('Unable to post comment.'));
    });
});

function getMembers(rank, page)
{
    $.get('/api/groups/members', { id, rank, page }).done((data) => {
        $('#members').html('');

        if (typeof data.error !== 'undefined')
            return $('#members').html(`<div class="col">${data.error}</div>`);

        $.each(data.members, function() {
            $('#members').append(`
            <div class="col-6 col-md-3">
                <div class="card text-center" style="border:none;">
                    <a href="${this.url}">
                        <img src="${this.thumbnail}">
                        <div class="text-truncate mt-2">${this.username}</div>
                    </a>
                </div>
            </div>`);
        });

        if (data.total_pages > 1) {
            const previousDisabled = (data.current_page == 1) ? 'disabled' : '';
            const nextDisabled = (data.current_page == data.total_pages) ? 'disabled' : '';
            const previousPage = data.current_page - 1;
            const nextPage = data.current_page + 1;

            $('#members').append(`
            <div class="col-12 text-center">
                <button class="btn btn-sm btn-danger" onclick="getMembers(${rank}, ${previousPage})" ${previousDisabled}>&laquo;</button>
                <span class="text-muted ml-2 mr-2">${data.current_page} of ${data.total_pages}</span>
                <button class="btn btn-sm btn-success" onclick="getMembers(${rank}, ${nextPage})" ${nextDisabled}>&raquo;</button>
            </div>`);
        }
    }).fail(() => $('#members').html('<div class="col">Unable to get members.</div>'));
}

function getItems(page)
{
    $.get('/api/groups/items', { id, page }).done((data) => {
        $('#items').html('');

        if (typeof data.error !== 'undefined')
            return $('#items').html(`<div class="col">${data.error}</div>`);

        $.each(data.items, function() {
            var price = `<span><i class="currency"></i> ${this.price}</span>`;

            if (this.onsale && this.price == 0)
                price = `<span class="text-success">Free</span>`;
            else if (!this.onsale)
                price = `<span class="text-muted">Off Sale</span>`;

            $('#items').append(`
            <div class="col-6 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="${this.url}" style="color:inherit;font-weight:600;">
                            <img src="${this.thumbnail}" style="width:90%;margin:0 auto;display:block;">
                            <div class="text-truncate">${this.name}</div>
                        </a>
                        <span>${price}</span>
                    </div>
                </div>
            </div>`);
        });

        if (data.total_pages > 1) {
            const previousDisabled = (data.current_page == 1) ? 'disabled' : '';
            const nextDisabled = (data.current_page == data.total_pages) ? 'disabled' : '';
            const previousPage = data.current_page - 1;
            const nextPage = data.current_page + 1;

            $('#items').append(`
            <div class="col-12 text-center">
                <button class="btn btn-sm btn-danger" onclick="getItems(${previousPage})" ${previousDisabled}>&laquo;</button>
                <span class="text-muted ml-2 mr-2">${data.current_page} of ${data.total_pages}</span>
                <button class="btn btn-sm btn-success" onclick="getItems(${nextPage})" ${nextDisabled}>&raquo;</button>
            </div>`);
        }
    }).fail(() => $('#items').html('<div class="col">Unable to get items.</div>'));;
}

function getWallPosts(page)
{
    $.get('/api/groups/wall', { id, page }).done((data) => {
        $('#wall').html('');

        if (typeof data.error !== 'undefined')
            return $('#wall_errors').html(data.error);

        $.each(data.posts, function() {
            var modTools = '';
            var togglePin = (this.is_pinned) ? 'Unpin Post' : 'Pin Post';
            var PinIcon = (this.is_pinned) ? `<i class="material-icons group-pin" title="This is a pinned post">pin_drop</i>` : ``;
            if (canModerateWall)
                modTools = `
               <span class="wall-settings" data-toggle="wall-${this.id}-dropdown"><i class="material-icons">settings</i></span>
											<div class="dropdown-pane creator-area-dropdown" id="wall-${this.id}-dropdown" data-dropdown data-hover="true" data-hover-pane="true">
		<ul>
                                            
               <li>
               <button onclick="togglePinWallPost(${this.id})">${togglePin}</button>
               </li>
               
               <li>
               <button onclick="deleteWallPost(${this.id})">Delete Post</button>
               </li>
               
        </ul>
	</div>`;

            $('#wall').append(`
            <div class="wall-post">
								<div class="wall-post-header">
									<div class="grid-x grid-margin-x align-middle">
											<div class="shrink cell no-margin">
												${PinIcon}
											</div>
										<div class="shrink cell no-margin">
											<div style="background-image:url(${this.creator.thumbnail});background-size:cover;" class="wall-post-avatar"></div>
										</div>
										<div class="auto cell no-margin">
											
											<a href="${this.creator.url}" class="wall-post-username">${this.creator.username}</a>
										</div>
										<div class="shrink cell no-margin right">
											<span class="wall-post-time">${this.time_ago}</span>
                                                    ${modTools}
										</div>
									</div>
								</div>
								<div class="wall-post-main">
									${this.body}
								</div>
							</div> 
                          
				</div>`);
        });

        if (data.total_pages > 1) {
            const previousDisabled = (data.current_page == 1) ? 'disabled' : '';
            const nextDisabled = (data.current_page == data.total_pages) ? 'disabled' : '';
            const previousPage = data.current_page - 1;
            const nextPage = data.current_page + 1;

            $('#wall').append(`
            <div class="col-12 text-center">
                <button class="btn btn-sm btn-danger" onclick="getWallPosts(${previousPage})" ${previousDisabled}>&laquo;</button>
                <span class="text-muted ml-2 mr-2">${data.current_page} of ${data.total_pages}</span>
                <button class="btn btn-sm btn-success" onclick="getWallPosts(${nextPage})" ${nextDisabled}>&raquo;</button>
            </div>`);
        }
    }).fail(() => $('#wall').html('Unable to get wall posts.'));;
}
