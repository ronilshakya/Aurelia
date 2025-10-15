jQuery(document).ready(function($){
    $('.hero-prev, .hero-next').on('click', function(){
        let button = $(this);
        let catId = button.data('category');
        let row = $('.aurelia-row[data-category="'+catId+'"]');
        let currentPage = parseInt(row.data('page'));
        let wrapper = row.closest('.aurelia-tab-wrapper');

        // Determine new page
        let newPage = button.hasClass('hero-next') ? currentPage + 1 : currentPage - 1;

        button.prop('disabled', true);

         wrapper.append(`
            <div class="aurelia-loading-overlay d-flex justify-content-center align-items-center">
                <i class="fa-solid fa-spinner fa-spin-pulse fa-2x text-white"></i>
            </div>
        `);

        $.ajax({
            url: aurelia_ajax.ajaxurl,
            type: 'POST',
            data: {
                action: 'aurelia_hero_pagination',
                category: catId,
                page: newPage
            },
            success: function(response){
                wrapper.find('.aurelia-loading-overlay').remove();
                if(response.trim() !== ''){
                    row.html(response);
                    row.data('page', newPage);

                    // Enable/disable buttons
                    $('.hero-prev[data-category="'+catId+'"]').prop('disabled', newPage <= 1);
                    $('.hero-next[data-category="'+catId+'"]').prop('disabled', response.trim() === '');
                    
                    button.prop('disabled', false).html(button.hasClass('hero-next') ? '<i class="fa-solid fa-caret-right"></i>' : '<i class="fa-solid fa-caret-left"></i>');
                } else {
                    button.prop('disabled', true).html(button.hasClass('hero-next') ? '<i class="fa-solid fa-caret-right"></i>' : '<i class="fa-solid fa-caret-left"></i>');
                }
            },
            error: function(){
                wrapper.find('.aurelia-loading-overlay').remove();
                button.prop('disabled', false).html(button.hasClass('hero-next') ? '<i class="fa-solid fa-caret-right"></i>' : '<i class="fa-solid fa-caret-left"></i>');
                alert('Error loading posts');
            }
        });
    });
});
