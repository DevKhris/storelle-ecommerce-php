$(function () {
    
    $('#review-box').hide();
    requestProducts();
});

// Show or hides the review box
function toggleReviewBox() {
        if ($('#review-box').is(':visible')) {        
            $('#review-box').hide();         
        } else {
             $('#review-box').show();
        }
}

function getBalance() {
    
}
    
function requestProducts() {
        $.ajax({
            url: "products",
            type: 'POST',
            success: function(res) {
                console.log(res);
                let products = JSON.parse(res);
                console.log(products);
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