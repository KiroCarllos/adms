function transferSelection() {
    var selectElement = document.getElementById('CM');
    var selectedOptions = getSelectedOptions(selectElement);
    var selectedBox = document.getElementById('selectedBox');
    selectedBox.innerHTML = selectedOptions;
  }

  function getSelectedOptions(selectElement) {
    var selectedOptions = '';
    for (var i = 0; i < selectElement.options.length; i++) {
      if (selectElement.options[i].selected) {
        selectedOptions += selectElement.options[i].text + '<br>';
      }
    }
    return selectedOptions;
  }




  function copyTask() {
    var taskName = document.querySelector('.taskname').value;
    var startDate = document.querySelectorAll('.taskdate')[0].value;
    var endDate = document.querySelectorAll('.taskdate')[1].value;

    var copiedTasks = document.getElementById('copiedTasks');
    var taskText = 'Task Name: ' + taskName + ', ' +
                   'Task Start Date: ' + startDate + ', ' +
                   'Task End Date: ' + endDate;

  var decrees= document.getElementById('decrees');
  decrees.value = taskText;

    var taskElement = document.createElement('p');
    taskElement.textContent = taskText;


      copiedTasks.appendChild(taskElement);
  }
