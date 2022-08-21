$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        let productId =$(this).data('product-id');
        console.log(productId);
        let quantity = $('#quantity').val() ? $('#quantity').val() : 1;
        console.log(quantity);
        let size = $('#number_size').val();
        console.log(size);
        $.ajax({
            url: '/home/add-to-cart',
            method: 'POST',
            data: {
                productId,
                quantity,
                size
            },
            success: function(data) {
                console.log(data);
                if (data.status == 200) {
                    if ($('#product_detail_page').length > 0) {
                        location.href = '/home/cart'
                    }
                    swal({icon: "success", title: "Thông báo!", text: data.message});
                    let currentQuantity = $('#cartQuantity').text();
                    $('#cartQuantity').text(parseInt(currentQuantity) + parseInt(quantity));
                } else {
                    swal({icon: "warning", title: "Thông báo!", text: data.message});
                }
            },
            error: function(err) {
                console.log({err});
                swal({icon: "error", title: 'Error', text: 'There are error when add to cart, please try again'});
            }
        });
    });
})