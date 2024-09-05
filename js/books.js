document.addEventListener("DOMContentLoaded", function () {
  const summaryElement = document.getElementById("summary-text");
  const summaryText = summaryElement.textContent.trim(); // Get the summary text from the HTML

  // Remove the summary text from the HTML to prepare for animation
  summaryElement.textContent = "";

  let currentIndex = 0;
  let interval;

  // Function to generate letters one by one
  function generateLetters() {
    if (currentIndex < summaryText.length) {
      summaryElement.textContent += summaryText[currentIndex];
      currentIndex++;
    } else {
      // Animation complete, stop further generation
      clearInterval(interval);
    }
  }

  interval = setInterval(generateLetters, 5);
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
  // Check if the item is already in the cart
  var itemAlreadyInCart = false;
  if (cartCount > 0) {
    itemAlreadyInCart = true;
  }

  // Perform add to cart action here
  // For demonstration, increment cart count by 1 if the item is not already in the cart
  if (!itemAlreadyInCart) {
    cartCount++;
    updateCartNotification(cartCount);
  }
}

// Example function to simulate viewing cart
function viewCart() {
  // Perform action to view cart
  console.log("View Cart");
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
