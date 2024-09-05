document.addEventListener("DOMContentLoaded", function () {
  const sidebarItems = document.querySelectorAll(".sidebars-item");
  const contentSections = document.querySelectorAll(".content");

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault();

      const target = this.getAttribute("data-target");

      contentSections.forEach((section) => {
        section.style.display = "none";
      });

      const selectedSection = document.getElementById(target);
      if (selectedSection) {
        selectedSection.style.display = "block";
      }

      sidebarItems.forEach((item) => {
        item.classList.remove("active");
      });

      this.classList.add("active");
    });
  });
});

function readBook(path) {
  console.log(path);
  window.open(`http://localhost:3000/${path}`, "_blank").focus();
}

function initiateTransaction(title, price, isbn, image) {
  const khaltiUrl = "https://a.khalti.com/api/v2/epayment/initiate/";
  const secretKey = "c5ab8ce422ee43358b89cf23ac84f104";
  console.log(title, Math.round(price));
  const payload = {
    return_url: "http://localhost:3000/src/Pages/confirmPayment.php",
    website_url: "http://localhost:3000/src/Pages/confirmPayment.php",
    amount: Math.round(price) * 100,
    purchase_order_id: isbn,
    purchase_order_name: JSON.stringify({
      title: title,
      isbn: isbn,
      image: image,
    }),
    customer_info: {
      name: "BookHub",
      email: "BookHub@gmail.com",
      phone: "9800000001",
    },
  };

  $.ajax({
    url: khaltiUrl,
    type: "POST",
    headers: {
      Authorization: "key " + secretKey,
      "Content-Type": "application/json",
    },
    data: JSON.stringify(payload),
    success: function (response) {
      console.log("Initiate Response:", response);
      // Handle the response, e.g., redirect to payment URL
      window.open(response.payment_url, "_blank").focus();

      // if (response.token) {
      //   window.location.href = response.payment_url;
      // }
    },
    error: function (xhr, status, error) {
      console.error("Initiate Error:", error);
      // Handle the error, e.g., display an error message
    },
  });
}

function deleteBooks(isbn) {
  $.ajax({
    type: "POST",
    url: "../Utils/deleteUserBooks.php",
    data: { isbn: isbn },
    success: function (response) {
      console.log(response);
      location.reload();
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
}
