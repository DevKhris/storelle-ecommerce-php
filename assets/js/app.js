$(function() {

    // render one product
    requestProduct();

    // renders the products
    requestProducts();


    // hide the review form
    $('#review-box').hide();

    // renders the shopping cart
    requestCart();

    $(document).on('click', '.cartItem-delete', function() {
        if (confirm('Are you sure you want to remove this product from cart?')) {
            let elm = $(this)[0].parentElement.parentElement;
            let id = $(elm).attr('cartId');
            $.post('shopping-cart', {
                id
            }, function(res) {
                requestCart();
            })
        }
    });

    $(document).on('click', '.product-add', function() {
        let productName = document.getElementById('productName');
        let productPrice = document.getElementById('productPrice');
        let product = {
            'name': productName,
            'price': productPrice,
        };
        $.post('product', {
            id
        }, function(res) {
            alert(id);
        })
    });
});

// Show or hides the review box
function toggleReviewBox() {
    if ($('#review-box').is(':visible')) {
        $('#review-box').hide();
    } else {
        $('#review-box').show();
    }
}

function requestProduct() {
    let id = $(this).attr('id');
    $.ajax({
        url: 'product'. id,
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
            <h3 class="text-muted" id="productPrice">$${product[0].price}</h3>
            <p>${product[0].rating}</p>
            <form class="form-group" action="" method="" id="add-form">
                <label for="productQuantity">Qty</label>
                <input class="form-control form-control-sm" min=1 value="1" type="number" name="productQuantity" id="productQuantity">
            <button type="submit" name="product-add" class="btn btn-product btn-block mt-5">
                    Add to cart
                    <i class="fa fa-shopping-cart"></i>
            </button>
            </form>          
            <br>
            `;
            $('#productInfo').html(productInfo);
            id = parseUrlParams('id');
            // renders the reviews
            requestReviews(id);
        }

    });
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
                            <img src="${product.img}" class="card-img-top img-fluid" alt="${product.img}">
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

function requestReviews(id) {
    console.log(id);
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
                console.log(review);
                template += `
                    <div class=" card">
                    <div class="card-header">
                        <h4 class="mt-3 mx-auto">
                            ${review.userName}
                        </h4>
                        <h5>
                            ${review.rating}
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
        url: 'shopping-cart',
        type: 'POST',
        success: function(req) {
            let cartItems = JSON.parse(req);
            //console.log(cartItems);
            let template = '';
            cartItems.forEach(cartItem => {
                template += `
                    <tr cartId="${cartItem.id}">
                        <td>${cartItem.id}</td>
                        <td>
                            <a href="product?id=${cartItem.id}" class="cart-item">${cartItem.name}</a>
                        </td>
                        <td>${cartItem.quantity}</td>
                        <td>${cartItem.price}</td>
                        <td>
                            <button href="&id=${cartItem.id}" class="btn btn-outline-danger cartItem-delete">X</button>
                        </td>
                    </tr>
                `
            });
            $('#cart').html(template);
            let form = ``;
        }
    });

}
// function cartHandler(handle,id) {
//     let query;
//     if (handle != "") {
//         switch (handle) {
//             case addProduct:
//                 query = 'a=' + handle + '&id=' + id + 'qty=' + $("#productQuantity" + id).val();
//                 break;

//             case removeProduct:
//                 query = 'a=' + handle + '%id=' + id;
//                 break;
//         }
//     }
// }
// 

function parseUrlParams(param)
{
    const query = window.location.search;
    const urlParams = new URLSearchParams(query);
    let result = urlParams.get(param);
    return result;
}