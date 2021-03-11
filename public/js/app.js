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
    case "/shopping-cart":
      // renders the shopping cart
      requestCart();
      break;
  }

  // hide the review form
  $("#review-form").hide();

  // handles add product from product view
  $("#product-form").submit(function (e) {
    e.preventDefault();
    // obtains product info and store in a array
    let productData = {
      productImage: $("#productImage").children("img").attr("src"),
      productId: parseUrlParams("id"),
      productName: $("#productName").html(),
      productPrice: $("#productPrice")
        .html()
        .replace('<i class="fa fa-dollar"></i>', ""),
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
      id: $("#productId").val(),
      feedback: $("#reviewContent").val(),
      rating: $("#reviewRating").val(),
    };
    // encode data to json
    postReview(reviewData);
    $("#review-form").trigger("reset");
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
                <div class="card-deck">
                    <a class="text-decoration-none product-link font-weight-bold" href="product/${product.id}">
                        <div class="card shadow-sm shadow-lg product text-center my-2">
                            <img src="${product.img}" class="card-img-top align-self-center img-fluid" width=360 height=240 alt="${product.name}">
                            <div class="card-body">
                                
                                <h3 class="card-title">${product.name}</h3>
                                <span class="card-text">$${product.price}</span>
                            </div>
                            <div class="card-footer">
                                <button href="product/${product.id}" class="btn btn-product">
                                 <i class="fa fa-shopping-cart"></i> View Product
                                </button>
                            </div>
                        </div>
                    </a>
                    </div>
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
  data = JSON.stringify(reviewData);
  $.ajax({
    url: "/reviews/" + reviewData.id,
    type: "POST",
    data: {
      review: data,
    },
    success: function (res) {
      console.log(res);
      $("#review-alerts").html(res);
    },
  });
}

/**
 * Request items from cart
 *
 * @return array cart items
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
      console.log(data);
      cartItems.forEach((cartItem) => {
        totalPrice += parseFloat(cartItem.price) * parseInt(cartItem.quantity);
        template += `
                    <tr cartId="${cartItem.id}">
                        <td>
                        <img class="img-thumbnail" src="${cartItem.image}" alt="${cartItem.image}" width=64 />
                        </td>
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
