$(document).ready(function() {
    $('.order-details-btn').click(function(e) {
        e.preventDefault();
        var orderId = $(this).data('order-id');

        $.ajax({
            url: '../controller/get_order_details.php',
            type: 'POST',
            data: { orderId: orderId },
            success: function(response) {
                $('#order-details-content').html(response);
                var modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
                modal.show();
            },
            error: function() {
                alert('Failed to fetch order details.');
            }
        });
    });
});