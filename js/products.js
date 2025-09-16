$(document).ready(function(){
    $('#search').on('input', function() {
        var query = $(this).val();
        $.ajax({
            url: '../controller/search_products.php',
            method: 'GET',
            data: { search: query },
            success: function(data) {
                $('#products-container').html(data);
            }
        });
    });
});