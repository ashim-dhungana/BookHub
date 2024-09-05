function showToast(message, type, duration = 3000) {
  console.log("toastDone ");
  const toastContainer = document.getElementById("toast-container");

  // Create toast element
  const toast = document.createElement("div");
  toast.className = `toast ${type}`;

  // Add icon based on type
  const icon = document.createElement("span");
  icon.className = "icon";
  if (type === "success") {
    icon.innerHTML = "&#10004;"; // Check mark icon for success
  } else if (type === "error") {
    icon.innerHTML = "&#10060;"; // Cross mark icon for error
  }

  // Add message text
  const messageElement = document.createElement("span");
  messageElement.innerText = message;

  // Append elements to toast
  toast.appendChild(icon);
  toast.appendChild(messageElement);

  // Append toast to container
  toastContainer.appendChild(toast);

  // Remove toast after duration
  setTimeout(() => {
    toast.remove();
  }, duration);
}
