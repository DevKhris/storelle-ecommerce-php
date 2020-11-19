// main document listener
$(function() {

    // switch for rendering according to url to avoid unwanted requests
    switch (getUrl()) {
        case '/':
            // renders the products at home
            requestProducts();
            break;
        case '/products':
            // renders the products
            requestProducts();          
            break;
        case '/product':
            // render one product
            requestProduct();
            break;
        case '/shopping-cart':
            // renders the shopping cart
            requestCart();
            break;
        default:
            break;
    }

    // hide the review form
    $('#review-form').hide();

    // handles add product from product view
    $('#product-form').submit(function(e) {
        e.preventDefault();
        // obtains product info and store in a array
        let productData = {
            'productId': parseUrlParams('id'),
            'productName': $('#productName').html(),
            'productPrice': $('#productPrice').html().replace('$', ''),
            'productQuantity': $('#productQuantity').val(),
        };
        // checks if the value it's not empty
        if (productData.productQuantity > 0) {
            // converts the productData to json
            let jsonData = JSON.stringify(productData);
            // calls function passing json a param
            addProduct(jsonData);
            // fetch cart
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
            'totalPrice': parseFloat($('#totalPrice').html().replace('Total: $', '')),
            'currentBalance': parseFloat($('#userBalance').html().replace('Balance: $','')),
        };
        if (cartData.totalPrice > cartData.currentBalance) {
            alerts = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Can't proceed, Insufficient funds!</strong>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>`;
            $('#alerts').html(alerts);
        } else {
            cartData.currentBalance = cartData.currentBalance - cartData.totalPrice;
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

// fetch product from id
function requestProduct() {
    // get id from attribute
    let id = $(this).attr('id');
    // do a post petition
    $.ajax({
        url: 'product'.id,
        type: "POST",
        data: {
            id: id,
        },
        dataType: 'json',
        success: function(product) {
            // render product to view
            let productImg = `<img class="img-fluid" src="${product[0].img}" alt="${product[0].img}" width=512 height=512>`
            $('#productImg').html(productImg);
            let productInfo = `
            <h1 class="text-monospace" id="productName">${product[0].name}</h1>
            <h3 class="text-muted" id="productPrice">${product[0].price}</h3>
            <p class="reviews num"><i class="fa fa-star stars"></i> ${product[0].rating} / 5 </p>
            `;
            $('#productInfo').html(productInfo);
            // parse url param id and store in var
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
            $('#alerts').html(res);
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
                <div class="col-sm-3">
                    <a class="text-decoration-none product-link font-weight-bold" href="product?id=${product.id}">
                        <div class="card product text-center">
                            <img src="${product.img}" class="card-img-top align-self-center img-fluid" width=360 height=240 alt="${product.img}">
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
        success: function (res) {
            $('#review-alerts').html(res);
        }
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
                <b><p class="text-md-right" id="totalPrice">Total: $${parseFloat(totalPrice)}</p></b>
                `;
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
            $('#alerts').html(res);
        }
    });
}

function getBalance()
{
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
    const query = window.location['pathname'];
    return query;
}