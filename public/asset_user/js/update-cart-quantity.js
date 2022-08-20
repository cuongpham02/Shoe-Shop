$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.cart_quantity_up, .cart_quantity_down').click(function(e) {
        e.preventDefault();
        const itemId = $(this).data('cart-item-id');    //data-cart-item-id="{{ $cartItem->id }}"
        let selector = '.cart_quantity_input-';     //<input class="cart_quantity_input-{{ $cartItem->id }}"
        $(selector + itemId).val($(this).data('selector') == 'up' ? parseInt($(selector + itemId).val()) + 1 : ($(selector + itemId).val() <= 1 ? 1 : parseInt($(selector + itemId).val()) - 1) )
        let cart_total_price = $('#total-amount-' + itemId).val();  //<span class="cart_total_price-{{ $cartItem->id }}">
        let quantity = $(selector + itemId).val();
        let money = quantity * parseFloat(cart_total_price);
        $('.cart_total_price-' + itemId).text( (money.format()));

        let amount = 0;
        for(let i = 0; i < $('tr .cart-total-item').length; i++) {
            const beforeReplace = $($('tr .cart-total-item')[i]).text();
            const afterReplace = beforeReplace.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
            amount += parseFloat(afterReplace);
        }
        $('#total_cart_amount').text(amount.format() + '$');
        $('#amount-estimate').text(amount.format() + '$');

    });
});

Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
