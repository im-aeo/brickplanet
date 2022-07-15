/**
 * MIT License
 *
 * Copyright (c) 2022 Aeo
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

var currentTab = 'hats';
var routes = {};
var itemTypesWithPadding = [];
var itemTypePadding = '0px';
var bodyColor;
var currentPage;
var currentPart;

$(() => {
    const meta = 'meta[name="routes"]';
    routes.regenerate = $(meta).attr('data-regen');
    routes.inventory = $(meta).attr('data-inventory');
    routes.wearing = $(meta).attr('data-wearing');
    routes.update = $(meta).attr('data-update');

    itemTypePadding = $('meta[name="item-type-padding-amount"]').attr('content');
    itemTypesWithPadding = JSON.parse($('meta[name="item-types-with-padding"]').attr('content'));

    inventory(currentTab, 1);
    wearing();

    $('[data-angle]').click(function() {
        update('angle', $(this).attr('data-angle'));
    });

    $('[data-part]').click(function() {
        currentPart = $(this).attr('data-part');

        var title = capitalizeWords(currentPart.replace('_', ' '));

        $('#colorsTitle').html(`${title} Color`);
        $('#colors').show(() => document.body.addEventListener('click', closePalette, false));
    });

    $('[data-color]').click(function() {
        bodyColor = $(this).css('background-color');

        update('color', $(this).attr('data-color'));
    });

    $('[data-regenerate]').click(function() {
        $(this).attr('disabled', true);

        $.post(routes.regenerate, { _token }).done((data) => {
            if (typeof data.error !== 'undefined')
                return showError(data.error);

            $('#character').attr('src', data.thumbnail);
        }).fail(() => showError('Unable to regenerate character.')).always(() => $(this).attr('disabled', false));
    });

    $('[data-tab]').click(function() {
        var oldTab = currentTab;

        $(`[data-tab="${currentTab}"]`).removeClass('active');
        $(this).addClass('active');

        currentTab = $(this).attr('data-tab');

        if (oldTab != currentTab)
            inventory(currentTab, 1);
    });
});

function closePalette(event) {
    if (event.target.id != 'colors' && event.target.id != 'colorsHeader') {
        document.body.removeEventListener('click', closePalette, false);
        $('#colors').hide();
    }
}

function update(action, id)
{
    var params = {};
    var thumbnail = $('#character').attr('src');
    var bodyPart = currentPart;

    $('#character').attr('src', '/img/spinner.gif');

    switch (action) {
        case 'wear':
            params = { _token, action, id };
            break;
        case 'remove':
            params = { _token, action, type: id };
            break;
        case 'angle':
            params = { _token, action, angle: id };
		if(id == "left"){
			$('[data-angle="'+id+'"]').addClass( "lr-active" );
			$('[data-angle="right"]').removeClass( "lr-active" );
		}else if(id == "right"){
			$('[data-angle="'+id+'"]').addClass( "lr-active" );
			$('[data-angle="left"]').removeClass( "lr-active" );
		}
            break;
        case 'color':
            params = { _token, action, color: id, body_part: bodyPart };
            break;
        default:
            return;
    }

    $.post(routes.update, params).done(function(data) {
        if (typeof data.error !== 'undefined')
            return showError(data.error);

        $('#character').attr('src', data.thumbnail);

        switch (action) {
            case 'wear':
                inventory(currentTab, currentPage);
                wearing();
                break;
            case 'remove':
                wearing();
                break;
            case 'angle':
                //$('.active[data-angle]').removeClass('active');
                //$(`[data-angle="${id}"]`).addClass('active');
                break;
            case 'color':
                $(`[data-part="${bodyPart}"]`).css('background-color', bodyColor);
                break;
        }
    }).fail(function() {
        $('#character').attr('src', thumbnail);
        showError('Unable to update character.');
    });
}

function wearing()
{
    $.get(routes.wearing).done((data) => {
        $('#wearing').html('');

        if (typeof data.error !== 'undefined')
            return $('#wearing').html(`<div class="col">${data.error}</div>`);

        $.each(data, function() {
            const padding = (itemTypesWithPadding.includes(this.type)) ? itemTypePadding : '0px';

            $('#wearing').append(`
		<div class="large-3 cell">
			<div class="edit-character-card text-center">
                    <a href="${this.url}" target="_blank">
                        <img src="${this.thumbnail}" class="card-image">
                        
                        
                    </a>
                    <a href="${this.url}" target="_blank">
                    
                    ${this.name}
                    
                    </a>
                    <button class="remove" onclick="update('remove', '${this.type}')"><i class="material-icons">close</i></button>
                </div>
            </div>
		</div>`);
        });
    }).fail(() => $('#wearing').html('<div class="col">Unable to get wearing items.</div>'));
}

function inventory(category, page)
{
    $.get(routes.inventory, { category, page }).done((data) => {
        $('#inventory').html('');
        currentPage = page;

        if (typeof data.error !== 'undefined')
            return $('#inventory').html(`<div class="col">${data.error}</div>`);

        $.each(data.items, function() {
            const disabled = (this.is_wearing) ? 'disabled' : '';
            const padding = (itemTypesWithPadding.includes(this.type)) ? itemTypePadding : '0px';

            $('#inventory').append(`
           <div class="large-3 cell">
			<div class="edit-character-card text-center">
                    <a href="${this.url}" target="_blank">
                        <img src="${this.thumbnail}" class="card-image">
                    </a>
                    
                    <a href="${this.url}" target="_blank">
                    
                    ${this.name}
                    
                    </a>
                    <button class="wear" onclick="update('wear', ${this.id})" ${disabled}><i class="material-icons">add</i></button>
                </div>
            </div>
		</div>`);
        });

        if (data.total_pages > 1) {
            const previousDisabled = (data.current_page == 1) ? 'disabled' : '';
            const nextDisabled = (data.current_page == data.total_pages) ? 'disabled' : '';
            const currentPage = (data.current_page) ? 'current' : '';
            const previousPage = data.current_page - 1;
            const nextPage = data.current_page + 1;

            $('#inventory').append(`
            <div class="push-10"></div>
		<ul class="pagination" role="navigation" aria-label="Pagination">
        
                <li class="pagination-previous ${previousDisabled}" onclick="inventory('${currentTab}', ${previousPage})">Previous <span class="show-for-sr">page</span>
                </li>
                
                
                
                
                <li class="${currentPage}">
                
                ${data.current_page} 
                </li>
                
                <li>
                ${nextPage} 
                
                
                </li>
                <li class="pagination-next ${nextDisabled}" onclick="inventory('${currentTab}', ${nextPage})">Next <span class="show-for-sr">page</span>
                </li>
                
            </ul>`);
        }
    }).fail(() => $('#inventory').html('Unable to get wearing items.'));
}

function showError(text)
{
    //$('#error #errorText').html(text);
    //$('#error').modal('show');
	console.log(text);
}

function capitalizeWords(words) {
    var separateWord = words.toLowerCase().split(' ');

    for (var i = 0; i < separateWord.length; i++) {
       separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
       separateWord[i].substring(1);
    }

    return separateWord.join(' ');
 }