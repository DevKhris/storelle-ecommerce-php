let shippingCost = 0;

// main document listener
$(function () {
  // switch for rendering according to url to avoid unwanted requests
  switch (getUrl()) {
    case "/":
      // renders the products at home
      requestProducts();
      break;
    case "/products":
      // renders the products
      requestProducts();
      break;
    case "/product":
      // render one product
      requestProduct();
      requestReviews(parseUrlParams("id"));
      break;
    case "/shopping-cart":
      // renders the shopping cart
      requestCart();
      break;
    default:
      break;
  }

  // hide the review form
  $("#review-form").hide();

  // handles add product from product view
  $("#product-form").submit(function (e) {
    e.preventDefault();
    // obtains product info and store in a array
    let productData = {
      productId: parseUrlParams("id"),
      productName: $("#productName").html(),
      productPrice: $("#productPrice").html().replace("$", ""),
      productQuantity: $("#productQuantity").val(),
    };
    // checks if the value it's not empty
    if (productData.productQuantity > 0) {
      // converts the productData to json
      let jsonData = JSON.stringify(productData);
      // calls function passing json a param
      addProduct(jsonData);
    }
  });

  $("#review-form").submit(function (e) {
    e.preventDefault();
    const reviewData = {
      productId: $("#productId").val(),
      feedback: $("#reviewContent").val(),
      rating: $("#reviewRating").val(),
    };
    // encode data to json
    let jsonData = JSON.stringify(reviewData);
    postReview(jsonData);
    $("#review-form").trigger("reset");
    // parse id to var from url
    id = parseUrlParams("id");
    // request reviews
    requestReviews(id);
  });

  $(document).on("click", ".cartItem-delete", function () {
    if (confirm("Are you sure you want to remove this product from cart?")) {
      let elm = $(this)[0].parentElement.parentElement;
      let id = $(elm).attr("cartId");
      // remove product by id
      removeProduct(id);
      // request cart
      requestCart();
    }
  });

  $(document).on("click", ".checkout", function () {
    // assign cart data by parsing element id's to array
    let cartData = {
      totalPrice: parseFloat($("#totalPrice").html().replace("Total: $", "")),
      currentBalance: parseFloat(
        $("#userBalance").html().replace("Balance: $", "")
      ),
    };
    // verify if the price is greater than the user balance
    if (cartData.totalPrice > cartData.currentBalance) {
      // if true thrown alert
      alerts = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Can't proceed, Insufficient funds!</strong>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>`;
      $("#alerts").html(alerts);
    } else {
      // get total balance
      cartData.currentBalance = cartData.currentBalance - cartData.totalPrice;
      // performs checkout from cart
      performCheckout(cartData);
      // request cart
      requestCart();
    }
  });
});

// Show or hides the review form
function toggleReviewBox() {
  if ($("#review-form").is(":visible")) {
    $("#review-form").hide();
  } else {
    $("#review-form").show();
  }
}

/**
 * Fetch product by Id
 * @return json product
 */
function requestProduct() {
  // get id from attribute
  let id = $(this).attr("id");
  $.ajax({
    url: "product".id,
    type: "POST",
    data: {
      id: id,
    },
    dataType: "json",
    success: function (product) {
      // render product to view
      let stars = '<i class="fa fa-star stars"></i>';
      let productImg = `<img class="img-thumbnail shadow-sm shadow-lg" src="${product.img}" alt="${product.name}" width=512 height=512>`;
      $("#productImg").html(productImg);
      let productInfo = `
            <div>
              <h1 class="text-monospace mt-3" id="productName">
                ${product.name}
              </h1>
              <h3 class="text-muted" id="productPrice">
                <i class="fa fa-dollar"></i> ${product.price}
              </h3>
              <p class="reviews num" id="stars">
                ${stars}
                ${product.rating} / 5 
              </p>
            </div>
            `;
      $("#productInfo").html(productInfo);
      // parse url param id and store in var
      id = parseUrlParams("id");
      // renders the reviews
      requestReviews(id);
    },
  });
}

/**
 * Add product to shopping cart request
 * @param array data from product to add
 */
function addProduct(productData) {
  $.ajax({
    url: "/shopping-cart/add",
    type: "POST",
    data: {
      product: productData,
    },
    success: function (res) {
      $("#alerts").html(res);
    },
  });
}

/**
 * Remove product to shopping cart request
 * @param int id id from product to remove
 */
function removeProduct(id) {
  $.ajax({
    url: "/shopping-cart/remove",
    type: "POST",
    data: {
      id: id,
    },
    success: function (res) {
      $("#alerts").html(res);
    },
  });
}

/**
 * Request all products
 * @return json products
 */
function requestProducts() {
  $.ajax({
    url: "products",
    type: "POST",
    success: function (res) {
      let products = JSON.parse(res);
      let template = "";
      products.forEach((product) => {
        template += `
                <div class="col-sm-3">
                    <a class="text-decoration-none product-link font-weight-bold" href="product?id=${product.id}">
                        <div class="card shadow-sm shadow-lg product text-center my-2">
                            <img src="${product.img}" class="card-img-top align-self-center img-fluid" width=360 height=240 alt="${product.name}">
                            <div class="card-body">
                                
                                <h3 class="card-title">${product.name}</h3>
                                <span class="card-text">$${product.price}</span>
                            </div>
                            <div class="card-footer">
                                <button href="products?id=${product.id}" class="btn btn-product">
                                 <i class="fa fa-shopping-cart"></i> View Product
                                </button>
                            </div>
                        </div>
                    </a>
                </div>`;
      });
      $("#products").html(template);
    },
  });
}

/**
 * Request for posting review
 * @param  array reviewData review data to posts
 *
 * @return string           alert
 */
function postReview(reviewData) {
  $.ajax({
    url: "/publish",
    type: "POST",
    data: {
      review: reviewData,
    },
    success: function (res) {
      $("#review-alerts").html(res);
    },
  });
}

/**
 * Request all reviews for product by id
 * @param  int id product id
 *
 * @return string view
 */
function requestReviews(id) {
  $.ajax({
    url: "/review",
    type: "POST",
    data: {
      id: id,
    },
    success: function (json) {
      let reviews = JSON.parse(json);
      let template = "";
      reviews.forEach((review) => {
        template += `
                    <div class="reviews card">
                    <div class="card-header">
                        <h4 class="mt-3 mx-auto">
                            ${review.username}
                        </h4>
                        <h5>
                            <div id=stars>
                            <i class="fa fa-star stars"></i>
                             ${review.rating}
                            </div>
                           
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                        ${review.feedback}
                        </p>
                    </div>
                </div>
                `;
      });
      $("#reviews-box").html(template);
    },
  });
}

/**
 * [requestCart request items from cart]
 * @return {[array]} [cart items]
 */
function requestCart() {
  $.ajax({
    url: "/shopping-cart",
    type: "POST",
    success: function (data) {
      let currentBalance = getBalance();
      let cartItems = JSON.parse(data);

      let totalPrice = 0;
      let shippingCost = getShipping();
      let template = "";
      let pricing = "";
      cartItems.forEach((cartItem) => {
        totalPrice += parseFloat(cartItem.price) * parseInt(cartItem.quantity);
        template += `
                    <tr cartId="${cartItem.id}">
                        <td>${cartItem.productId}</td>
                        <td>
                            <a href="product?id=${cartItem.productId}" class="cart-item">${cartItem.name}</a>
                        </td>
                        <td>${cartItem.quantity}</td>
                        <td>$${cartItem.price}</td>
                        <td>
                            <button href="&id=${cartItem.id}" class="btn btn-outline-danger cartItem-delete">X</button>
                        </td>
                    </tr>
                `;
      });
      totalPrice = parseFloat(totalPrice) + parseInt(shippingCost);
      pricing += `
                <p class="text-md-right" id="userBalance">Balance: $${currentBalance}</p>
                <p class="text-md-right" id="shippingCost">Shipping Cost: $${parseInt(
                  shippingCost
                )}</p>
                <b><p class="text-md-right" id="totalPrice">Total: $${parseFloat(
                  totalPrice
                )}</p></b>
                `;
      $("#pricing").html(pricing);
      $("#cart").html(template);
    },
  });
}

function getShipping() {
  return shippingCost;
}

function setShipping(value) {
  shippingCost = value;
  requestCart();
}
/**
 * Performs the checkout request
 * @param  {array} cartData items in cart
 * @return {string}         alert
 */
function performCheckout(cartData) {
  $.ajax({
    url: "/checkout",
    type: "POST",
    data: {
      checkout: cartData,
    },
    success: function (data) {
      getBalance();
      $("#alerts").html(data);
    },
  }).fail(function (data) {
    $("#alerts").html(data);
  });
}

/**
 * Get user balance request
 * @return {json} balance
 */
function getBalance() {
  $.ajax({
    url: "/dashboard",
    type: "POST",
    data: { balance: "0" },
    dataType: "json",
    success: function (data) {
      $("#userBalance").html("Balance: $" + data);
    },
  });
}

/**
 * Parse param from url
 * @param  {string}      'param to parse'
 * @return {string}       parse result
 */
function parseUrlParams(param) {
  const query = window.location.search;
  const urlParams = new URLSearchParams(query);
  let result = urlParams.get(param);
  return result;
}

/**
 * Get url from path name
 * @return {string} relative path
 */
function getUrl() {
  const query = window.location["pathname"];
  return query;
}
