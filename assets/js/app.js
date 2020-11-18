$(function() {

    // renders the products
    requestProducts();

    // render one product
    requestProduct();

    // hide the review form
    $('#review-form').hide();

    // renders the shopping cart
    requestCart();

    $('#product-form').submit(function(e) {
        e.preventDefault();
        let productData = {
            'productId': parseUrlParams('id'),
            'productName': $('#productName').html(),
            'productPrice': $('#productPrice').html().replace('$', ''),
            'productQuantity': $('#productQuantity').val(),
        };
        if (productData.productQuantity > 0) {
            let jsonData = JSON.stringify(productData);
            addProduct(jsonData);
            requestCart();
        }
    });

    $('#review-form').submit(function(e) {
        e.preventDefault();
        const reviewData = {
            productId: $('#productId').val(),
            feedBack: $('#reviewContent').val(),
            rating: $('#reviewRating').val(),
        };
        let jsonData = JSON.stringify(reviewData);
        postReview(jsonData);
        $('#review-form').trigger('reset');
        id = parseUrlParams('id');
        requestReviews(id);
    });

    $(document).on('click', '.cartItem-delete', function() {
        if (confirm('Are you sure you want to remove this product from cart?')) {
            let elm = $(this)[0].parentElement.parentElement;
            let id = $(elm).attr('cartId');
            removeProduct(id);
            requestCart();
        }
    });

    $(document).on('click', '.checkout', function() {
        let cartData = {
            'totalPrice': $('#totalPrice').html().replace('Total: $', ''),
            'currentBalance': $('#userBalance').html().replace('Balance: $',''),
        };
        if (cartData.currentBalance < cartData.totalprice){
            console.log('Insufficien funds');
        } else {
         performCheckout(cartData);
         requestCart();           
        }
    });

});

// Show or hides the review form
function toggleReviewBox() {
    if ($('#review-form').is(':visible')) {
        $('#review-form').hide();
    } else {
        $('#review-form').show();
    }
}

function requestProduct() {
    let id = $(this).attr('id');
    $.ajax({
        url: 'product'.id,
        type: "POST",
        data: {
            id: id,
        },
        dataType: 'json',
        success: function(product) {
            let productImg = `<img class="img-fluid" src="${product[0].img}" alt="${product[0].img}" width=512 height=512>`
            $('#productImg').html(productImg);
            let productInfo = `
            <h1 class="text-monospace" id="productName">${product[0].name}</h1>
            <h3 class="text-muted" id="productPrice">${product[0].price}</h3>
            <p class="reviews num"><i class="fa fa-star stars"></i> ${product[0].rating} / 5 </p>
            `;
            $('#productInfo').html(productInfo);
            id = parseUrlParams('id');
            // renders the reviews
            requestReviews(id);
        }

    });
}

function addProduct(productData) {
    $.ajax({
        url: '/shopping-cart',
        type: 'POST',
        data: {
            product: productData
        },
        success: function(res) {

        }
    });
}

function removeProduct(id) {
    $.ajax({
        url: '/shopping-cart',
        type: 'POST',
        data: {
            id: id
        },
        success: function(res) {
            $('#alerts').html(res);
        }
    })
}

function requestProducts() {
    $.ajax({
        url: "products",
        type: 'POST',
        success: function(res) {
            let products = JSON.parse(res);
            let template = '';
            products.forEach(product => {
                template += `
                <div class="col-sm-2">
                    <a class="text-decoration-none product-link font-weight-bold" href="product?id=${product.id}">
                        <div class="card product text-center">
                            <img src="${product.img}" class="card-img-top " width=360 height=230 alt="${product.img}">
                            <div class="card-body">
                                <h5 class="card-title">${product.name}</h5>
                                <span class="card-text">$${product.price}</span>
                            </div>
                            <div class="card-footer">
                                <button href="products?id=${product.id}" class="btn btn-product">View Product</button>
                            </div>
                        </div>
                    </a>
                </div>`;
            });
            $('#products').html(template);
        }
    });
}

function postReview(reviewData) {
    $.ajax({
        url: '/review',
        type: 'POST',
        data: {
            review: reviewData
        },
        success: function(res) {}
    });

}

function requestReviews(id) {
    $.ajax({
        url: '/reviews',
        type: 'POST',
        data: {
            id: id,
        },
        success: function(res) {
            let reviews = JSON.parse(res);
            let template = '';
            reviews.forEach(review => {
                template += `
                    <div class="reviews card">
                    <div class="card-header">
                        <h4 class="mt-3 mx-auto">
                            ${review.userName}
                        </h4>
                        <h5>
                            <i class="fa fa-star stars"></i> ${review.rating}
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            ${review.feedBack}
                        </p>
                    </div>
                </div> 
                `;
            });

            $('#reviews-box').html(template);
        }
    });

}

function requestCart() {
    $.ajax({
        url: '/shopping-cart',
        type: 'POST',
        success: function (req) {
            let currentBalance = getBalance();
            let cartItems = JSON.parse(req);
            let totalPrice = 0;
            let shippingCost = parseUrlParams('shipping') ?? 0;
            let template = '';
            let pricing = '';
            cartItems.forEach(cartItem => {
                totalPrice += parseFloat(cartItem.productPrice) * parseInt(cartItem.productQuantity);
                template += `
                    <tr cartId="${cartItem.id}">
                        <td>${cartItem.id}</td>
                        <td>
                            <a href="product?id=${cartItem.productId}" class="cart-item">${cartItem.productName}</a>
                        </td>
                        <td>${cartItem.productQuantity}</td>
                        <td>$${cartItem.productPrice}</td>
                        <td>
                            <button href="&id=${cartItem.id}" class="btn btn-outline-danger cartItem-delete">X</button>
                        </td>
                    </tr>
                `
            });
            totalPrice = parseFloat(totalPrice) + parseInt(shippingCost);
            pricing += `
                <p class="text-md-right" id="userBalance">Balance: $${currentBalance}</p>
                <p class="text-md-right" id="shippingCost">Shipping Cost: $${parseInt(shippingCost)}</p>
                <p class="text-md-right" id="totalPrice"><b>Total: $${parseFloat(totalPrice)}</b></p>
                `
            $('#cart').html(template);
            $('#pricing').html(pricing);
        }
    });

}

function performCheckout(cartData)
{
    $.ajax({
        url: '/shopping-cart',
        type: 'POST',
        data: {
            checkout: cartData
        },
        success: function(res) {
            alert(res);
        }
    });
}

function getBalance()
{
    let currentBalance;
    $.ajax({
        url: '/profile',
        type: 'POST',
        data: { balance: '' },
        dataType: 'json',
        success: function (data) {
            $('#userBalance').html('Balance: $' + data[0].balance);
        }
    });
}

function parseUrlParams(param)
{
    const query = window.location.search;
    const urlParams = new URLSearchParams(query);
    let result = urlParams.get(param);
    return result;
}

function getUrl()
{
    const query = windows.location.search;
    return query;
}