$(document).ready(function (){

    $('.add-product-btn').on('click',function (e){

        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'), 2);



        $(this).removeClass('btn-success').addClass('btn-danger disabled')


        var html =
            `<tr>
                <td>${name}</td>
                <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price">${price}</td>
                <td><button class="btn btn-sm btn-danger remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;

        $('.order-list').append(html);
        calculateTotal();
    }); // end of add-product-btn

    $('body').on('click','.disabled', function (e){

        e.preventDefault();
    }); // end of disabled

    $('body').on('click','.remove-product-btn', function (e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-danger disabled').addClass('btn-success');

        calculateTotal();
    }); // end of remove-product-btn

    $('body').on('keyup change','.product-quantity', function (){

        var quantity = Number($(this).val());
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice, 2));
        calculateTotal();
    }); // end of product-quantity

    $('.order-products-btn').on('click', function (e){

        e.preventDefault();

        var url = $(this).data('url');
        var method = $(this).data('method');

        $.ajax({
            url: url,
            method: method,
            success: function (data) {
                $('#order-products-list').empty();
                $('#order-products-list').append(data);
            }
        }) // end of ajax

    }); // end of order-product-btn

    $(document).on('click', '.print-btn' , function () {

        $('#print-area').printThis();
    }); // end of function printThis

}); // End of Document

// Calculate Total
function calculateTotal(){

    var price = 0;

    $('.order-list .product-price').each(function (index){

        price += parseFloat($(this).html().replace(/,/g, ''));

    });// end of product price

    $('.total-price').html($.number(price, 2));

    // check if price > 0
    if (price > 0) {

        $('#add-order-form-btn').removeClass('disabled');

    } else {

        $('#add-order-form-btn').addClass('disabled');
    }// end else

} // end of calculate total

