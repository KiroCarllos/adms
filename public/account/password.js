function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password-input");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }