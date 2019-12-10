$(document).ready(function () {
    // add product bnt 
    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'), 2);
            //    <input type="hidden" name="product_ids[]" value="${id}">
            $(this).removeClass('btn-success').addClass('btn-default disabled');

        var html = `
        <tr>
        <td> ${name}</td>
        <td><input type="number" data-price="${price}" name="products[${id}][quantity]" min="1" value="1" class="form-control product-quantity"></td>
        <td class="product-price">${price}</td>
        <td> <button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}">
        <span class="fa fa-trash"> </span>
        </button> </td>
        </tr>
        `;

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
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, '')); //150
        console.log(unitPrice);
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice, 2));
        calculate_total();
    
    }); //end of product quantity change
    $('.order-products').on('click',function(e){
      e.preventDefault();
    
     
      $('#loading').css('display', 'flex');
        
      var url = $(this).data('url');
      var method = $(this).data('method');
      $.ajax({
          url: url,
          method: method,
          success: function(data) {

              $('#loading').css('display', 'none');
              $('#order-product-list').empty();
              $('#order-product-list').append(data);
            console.log(data);

          }
      });
    }); // end of order products
     //print order
     $(document).on('click','.print-btn',function(){
      $('#print-area').printThis();
     });

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
