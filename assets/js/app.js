$(function () {
    $('#review-box').hide();
    requestProduct();
    requestProducts();
    requestCart();
});

// Show or hides the review box
function toggleReviewBox() {
        if ($('#review-box').is(':visible')) {        
            $('#review-box').hide();         
        } else {
             $('#review-box').show();
        }
}

function requestProduct()
{   
    let id;
    $.ajax({
        url: 'product' . id,
        type: "POST",
        data: {
            id: $(this).attr('id'),
        },
        dataType: 'json',
        success: function (product) {
            console.log(product);
            let productImg = `<img class="img-fluid" src="${product[0].img}" alt="${product[0].img}" width=512 height=512>` 
            $('#productImg').html(productImg);
            let productInfo = `
            <h1 class="text-monospace">${product[0].name}</h1>
            <h3 class="text-muted">$${product[0].price}</h3>
            <p>${product[0].rating}</p>
            <form class="form-group" method="POST">
            <label for="productQuantity">Qty</label>
            <input class="form-control form-control-sm" min=1 value="1" type="number" name="productQuantity" id="productQuantity">
            <button type="submit" value="" name="addBtn" class="btn btn-product btn-block mt-5">Add to cart <i class="fa fa-shopping-cart"></i></button>
            </form>
            <br>
            `
            $('#productInfo').html(productInfo);
            }
            
        }
    );
}

function requestProducts()
{
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
                            <img src="${product.img}" class="card-img-top" alt="${product.img}">
                            <div class="card-body">
                                <h5 class="card-title">${product.name}</h5>
                                <span class="card-text">$${product.price}</span>
                            </div>
                            <div class="card-footer">
                                <button href="products?id=${product.id}" class="btn btn-product">View Product</button>
                            </div>
                        </div>
                    </a>
                </div>`
                });
                $('#products').html(template);
            }
        });
    }

function requestCart()
{
    $.ajax({
        url: 'shopping-cart',
        type: 'POST',
        success: function (req) {
            let cartItems = JSON.parse(req);
            console.log(cartItems);
            let template = '';
            cartItems.forEach(cartItem => {
                template += `
                    <tr cartId="${cartItem.id}">
                        <td>${cartItem.id}</td>
                        <td>
                            <a href="product?id=${cartItem.id}" class="task-item">${cartItem.name}</a>
                        </td>
                        <td>${cartItem.quantity}</td>
                        <td>${cartItem.price}</td>
                        <td>
                            <button class="btn btn-outline-danger cartItem-delete">X</button>
                        </td>
                    </tr>
                `
            });
             $('#cart').html(template);
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