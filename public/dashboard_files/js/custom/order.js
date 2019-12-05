$(document).ready(function () {
    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'), 2);
        var html = `
        <tr>
        <td> ${name}</td>
        <td><input type="number" data-price="${price}" name="quantities[]" min="1" value="1" class="form-control product-quantity"></td>
        <td class="product-price">${price}</td>
        <td> <button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}">
        <span class="fa fa-trash"> </span>
        </button> </td>
        </tr>
        `;

        $(this).removeClass('btn-success').addClass('btn-default disabled');
        $('.order-list').append(html);
        calculate_total();

    });

    // disabled btn 

    $('body').on('click', '.disabled', function (e) {
        e.preventDefault();

    }); // end of disabled

    // remove product btn 

    $('body').on('click', '.remove-product-btn', function (e) {
        e.preventDefault();
        var id = $(this).data(`id`);
        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn btn-success');
        calculate_total();
    }); // end of remove btn 
    //change product quantity
    $('body').on('keyup change', '.product-quantity', function () {

        var quantity = parseInt($(this).val()); //2
        var unitPrice = $(this).data('price'); //150
        console.log(unitPrice);
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice, 2));
        calculate_total();

    }); //end of product quantity change
});

//  calculate total function 

function calculate_total() {
    var price = 0;
    $('.order-list .product-price').each(function (index) {
       price += parseFloat($(this).html().replace(/,/g, ''));

        // price += Number($(this).html());
    }); // end of product price 
    $('.total-price').html($.number(price, 2));

    if(price > 0)
    {
         $('#add-order-form-btn').removeClass('disabled');
    }else {
        $('#add-order-form-btn').addClass('disabled');

    }
} // end of calculate total
