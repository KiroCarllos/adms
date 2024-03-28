var headTextArea = document.getElementById("headTextArea");
var membersTextArea = document.getElementById("membersTextArea");

function enableEditMode(textareaId) {
  var textarea = document.getElementById(textareaId);
  textarea.removeAttribute("readonly");
}

function saveToLocalStorage(key, value) {
  localStorage.setItem(key, value);
}

function getFromLocalStorage(key) {
  return localStorage.getItem(key);
}

window.addEventListener("DOMContentLoaded", function() {
  // Retrieve the stored values from localStorage
  var headLastUpdatedContent = getFromLocalStorage("headLastUpdatedContent");
  var membersLastUpdatedContent = getFromLocalStorage("membersLastUpdatedContent");

  // Set the stored values as the initial textarea values
  headTextArea.value = headLastUpdatedContent;
  membersTextArea.value = membersLastUpdatedContent;
});

headTextArea.addEventListener("input", function() {
  if (!headTextArea.hasAttribute("readonly")) {
    saveToLocalStorage("headLastUpdatedContent", headTextArea.value);
  }
});

membersTextArea.addEventListener("input", function() {
  if (!membersTextArea.hasAttribute("readonly")) {
    saveToLocalStorage("membersLastUpdatedContent", membersTextArea.value);
  }
});

headTextArea.setAttribute("readonly", "readonly");
membersTextArea.setAttribute("readonly", "readonly");