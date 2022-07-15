var currentCategory = '';
var currentSearch = '';
var itemTypesWithPadding = [];
var itemTypePadding = '0px';

$(() => {
    itemTypePadding = $('meta[name="item-type-padding-amount"]').attr('content');
    itemTypesWithPadding = JSON.parse($('meta[name="item-types-with-padding"]').attr('content'));

    $('#search').submit(function(event) {
        event.preventDefault();

        var oldSearch = currentSearch;
        currentSearch = $(this).find('input').val();

        if (currentSearch != oldSearch)
            search(currentCategory, 1, currentSearch);
    });

    $('[data-category]').click(function() {
        var oldCategory = currentCategory;

        $(`[data-category="${currentCategory}"]`).removeClass('active');
        $(this).addClass('active');

        currentCategory = $(this).attr('data-category');

        if (currentCategory != oldCategory)
            search(currentCategory, 1, currentSearch);
    });
    
    search('hats', 1, currentSearch);
});

function search(category, page, search)
{
    $.get('/api/catalog/search', { category, page, search }).done((data) => {
        $('#items-div').html('');
        currentCategory = category;
        currentSearch = search;

        if (typeof data.error !== 'undefined')
            return $('#items').html(`${data.error}`);

        $.each(data.items, function() {
            var price = `<div class="card-item-price"> ${this.price} Bits</div>`;
            var header = '';
            const padding = (itemTypesWithPadding.includes(this.type)) ? itemTypePadding : '0px';

            if (this.onsale && this.price == 0)
                price = `<div class="card-item-price" title="Free"><font class="coins-text">Free</font></div>`;
            else if (!this.onsale)
                price = `<div class="card-item-price">Off-Sale</div>`;

            if (this.limited) {
                header = `
                <div class="bg-primary text-white text-center" style="border-radius:50%;width:30px;height:30px;position:absolute;margin-left:5px;margin-top:5px;">
                    <span style="font-size:20px;font-weight:600;margin-top:7px;"><i class="material-icons">star</i></span>
                </div>`;
            } else if (this.timed) {
                header = `
                <div class="bg-danger text-white text-center" style="border-radius:50%;width:30px;height:30px;position:absolute;margin-left:5px;margin-top:5px;">
                    <span style="font-size:17px;font-weight:600;"><i class="material-icons">alarm</i></span>
                </div>`;
            }

            $('#items-div').append(`
            <div class="large-custom-2-4 medium-4 small-6 cell">
				<div class="border-r store-item-card">
					<div class="card-image" style="position:relative;">
                        <a href="${this.url}">
                            ${header}
                            <img style="background:var(--section_bg_inside);border-radius:6px;padding:${padding};" src="${this.thumbnail}">
                        </a>
                        </div>
					<div class="card-divider"></div>
					<div class="card-body">
						<div class="grid-x grid-margin-x">
							<div class="auto cell">
								<div class="card-item-name"><a href="${this.url}" style="color:inherit;">${this.name}</a></div>
                                </div>
						</div>
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell text-left">
								<div class="card-item-creator">
                                <a href="${this.creator.url}" style="color:inherit;">
                                    ${this.creator.username}
                                    
                                </a>
                                ${price}
                            </div>
                            </div>
                        
							</div>
						</div>
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
                <button class="btn btn-sm btn-danger" onclick="search('${currentCategory}', ${previousPage}, '${currentSearch}')" ${previousDisabled}>&laquo;</button>
                <span class="text-muted ml-2 mr-2">${data.current_page} of ${data.total_pages}</span>
                <button class="btn btn-sm btn-success" onclick="search('${currentCategory}', ${nextPage}, '${currentSearch}')" ${nextDisabled}>&raquo;</button>
            </div>`);
        }
    }).fail(() => $('#items').html('Unable to get items.'));;
}
