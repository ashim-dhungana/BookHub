// Event delegation for removing items from cart
$(document).on("click", "a.remove", function (event) {
  event.preventDefault();
  $(this)
    .closest("li.items")
    .hide(400, function () {
      // After hiding the item, recalculate the total
      calculateTotal();
      removeItemFromCart(); // Call function to remove item from cart and update notification
    });
});

// Function to calculate total values
function calculateTotal() {
  var subtotal = 0;

  // Loop through each visible item and calculate subtotal
  $("li.items:visible").each(function () {
    var quantityInput = $(this).find(".qty");
    var quantity = parseInt(quantityInput.val());
    if (!isNaN(quantity)) {
      var priceText = $(this).find(".prodTotal p").text().replace("$", "");
      var price = parseFloat(priceText);
      if (!isNaN(price)) {
        subtotal += quantity * price;
      } else {
        console.error("Invalid price:", priceText);
      }
    } else {
      console.error("Invalid quantity:", quantityInput.val());
    }
  });

  // Update subtotal
  $(".subtotal .value").text("$" + subtotal.toFixed(2));

  // Calculate shipping, tax, and total
  var shipping = 5.0; // Example shipping cost
  var taxRate = 0.1; // Example tax rate (10%)
  var tax = subtotal * taxRate; // Calculate tax
  var total = subtotal + shipping + tax; // Calculate total

  // Update shipping, tax, and total values in the HTML
  $(".shipping .value").text("$" + shipping.toFixed(2));
  $(".tax .value").text("$" + tax.toFixed(2));
  $(".total .value").text("$" + total.toFixed(2));
}

document.addEventListener("DOMContentLoaded", function () {
  const cartIcon = document.getElementById("cart-btn");
  const cartContainer = document.querySelector(".cart-container");
  const closeCartBtn = document.getElementById("close-cart-btn"); // Update to use getElementById

  cartIcon.addEventListener("click", function () {
    cartContainer.classList.toggle("active");
  });

  closeCartBtn.addEventListener("click", function () {
    cartContainer.classList.remove("active");
  });
});

// JavaScript code for updating the cart notification count

function updateCartNotification(count) {
  var notificationElement = document.getElementById("cart-notification");
  if (count > 0) {
    notificationElement.style.display = "inline-block";
    notificationElement.textContent = count;
  } else {
    notificationElement.style.display = "none";
  }
}

// Example function to simulate adding item to cart
function addItemToCart() {
  cartCount++;
  updateCartNotification(cartCount);
}

// Example function to simulate removing item from cart
function removeItemFromCart() {
  if (cartCount > 0) {
    cartCount--;
    updateCartNotification(cartCount);
  }
}

var cartCount = 0; // Initialize cart count
updateCartNotification(cartCount); // Update notification initially

// Event listener for clicking add to cart button
document
  .getElementById("addToCartForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission
    addItemToCart(); // Call function to add item to cart
  });

// Event listener for clicking shopping cart icon
document.getElementById("cart-btn").addEventListener("click", function () {
  viewCart(); // Call function to view cart
});



// SENDING CART DATA TO DATABASE

function addToCart(isbn) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/src/Utils/addToCart.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  xhr.send("isbn=" + isbn);

  window.location.reload();
}

// SENDING SALES DATA TO DATABASE

function addToSales(isbn, price, title) {
  var id = "<?php echo $userId; ?>";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/src/Utils/addToSales.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  xhr.send("isbn=" + isbn + "&price=" + price + "&title=" + title);
  window.location.reload();
}

function removeFromCart(isbn) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/src/Utils/RemoveFromCart.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  xhr.send("isbn=" + isbn);
  window.location.reload();
}

// SENDING REVIEW TO DATABASE

function addReview(isbn) {

  var review = document.getElementById("userInput").value;

  console.log(isbn);
  console.log(review);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/src/Utils/review.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.send('isbn=' + isbn + '&review=' + encodeURIComponent(review));

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log(xhr.responseText);
      }
    }
  };
  
  window.location.reload();
}
