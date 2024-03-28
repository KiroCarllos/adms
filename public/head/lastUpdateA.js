var missionLastUpdatedText = document.getElementById("missionLastUpdatedText");
var goalsLastUpdatedText = document.getElementById("goalsLastUpdatedText");
var missionTextArea = document.getElementById("missionTextArea");
var goalsTextArea = document.getElementById("goalsTextArea");
var missionPenIcon = document.querySelector("#missionLastUpdatedText + .pen-icon");
var goalsPenIcon = document.querySelector("#goalsLastUpdatedText + .pen-icon");
var missionLastUpdatedDate = localStorage.getItem("missionLastUpdatedDate");
var goalsLastUpdatedDate = localStorage.getItem("goalsLastUpdatedDate");
var missionLastUpdatedContent = localStorage.getItem("missionLastUpdatedContent");
var goalsLastUpdatedContent = localStorage.getItem("goalsLastUpdatedContent");

function updateLastUpdated(elementId) {
  var currentDate = new Date();
  var formattedDate = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1) + "-" + currentDate.getDate();

  if (elementId === "missionLastUpdatedText") {
    missionLastUpdatedDate = formattedDate;
    missionLastUpdatedContent = missionTextArea.value;
    localStorage.setItem("missionLastUpdatedDate", missionLastUpdatedDate);
    localStorage.setItem("missionLastUpdatedContent", missionLastUpdatedContent);
    missionLastUpdatedText.innerHTML = "Last Update:<br>" + missionLastUpdatedDate;
    missionTextArea.removeAttribute("readonly");
  } else if (elementId === "goalsLastUpdatedText") {
    goalsLastUpdatedDate = formattedDate;
    goalsLastUpdatedContent = goalsTextArea.value;
    localStorage.setItem("goalsLastUpdatedDate", goalsLastUpdatedDate);
    localStorage.setItem("goalsLastUpdatedContent", goalsLastUpdatedContent);
    goalsLastUpdatedText.innerHTML = "Last Update:<br>" + goalsLastUpdatedDate;
    goalsTextArea.removeAttribute("readonly");
  }
}

if (missionLastUpdatedDate) {
  missionLastUpdatedText.innerHTML = "Last Update:<br>" + missionLastUpdatedDate;
  missionTextArea.value = missionLastUpdatedContent;
}

if (goalsLastUpdatedDate) {
  goalsLastUpdatedText.innerHTML = "Last Update:<br>" + goalsLastUpdatedDate;
  goalsTextArea.value = goalsLastUpdatedContent;
}

missionTextArea.setAttribute("readonly", "readonly");
goalsTextArea.setAttribute("readonly", "readonly");

missionPenIcon.addEventListener("click", function() {
  updateLastUpdated("missionLastUpdatedText");
});

goalsPenIcon.addEventListener("click", function() {
  updateLastUpdated("goalsLastUpdatedText");
});


