$(document).ready(function() {
    $('.category-link').on('click', function() {
        var category = $(this).data('category');
        
        $.ajax({
            url: '{{route("admin.quanly.hanghoa-index")}}', // Điều chỉnh URL nếu cần thiết
            type: 'GET',
            data: { category: category },
            success: function(response) {
                $('#product-list-body').html($(response).find('#product-list-body').html());
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });
});
