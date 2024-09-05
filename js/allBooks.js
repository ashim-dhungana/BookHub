function deleteBooks(isbn) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/src/Utils/deleteBooks.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  xhr.send("isbn=" + isbn);
  window.location.reload();
}

function editBooks(isbn) {
  window.location.href = `/src/Utils/editBooks.php?isbn=${isbn}`;
}

// Function to handle search input

function handleSearchInput() {
  var searchTerm = document.getElementById("search-box").value;

  var formAction = "/src/Pages/allBooks.php?search=" + encodeURIComponent(searchTerm);

  document.getElementById("search-form").action = formAction;
}

// Event listener for search input

document.getElementById("search-box").addEventListener("input", function () {
  handleSearchInput();
});
