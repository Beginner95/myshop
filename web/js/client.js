function getCart(){
    $.ajax({
        url: '/client/cart/show',
        type: 'GET',
        success: function(res){
            if(!res) alert('Ошибка!');
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
    return false;
}

function showCart(cart) {
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
}

$('#cart .modal-body').on('click', '.del-item', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/client/cart/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Error!');
            showCart(res);
            $('#cart-client').html(res);
        },
        error: function () {
            alert('Error!');
        }
    });
});


function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Error!');
            showCart(res);
        },
        error: function () {
            alert('Error!');
        }
    });
}

$('.add-to-cart').on('click', function (e) {
    e.preventDefault(); //Отключаем переход по ссылке
    var id = $(this).data('id'),
        qty = $('#qty' + id).val();
    $.ajax({
        url: '/client/cart/add',
        data: {id: id, qty: qty},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Error!');
            //showCart(res);
            window.location.reload();
        },
        error: function () {
            alert('Error!');
        }
    });
});