const taskList = document.getElementById('task-list');

const tasks = [
    {
        assignee: 'Dr. Asmaa',
        task: 'Task 1',
        dueDate: '2023-12-11',
    },
    {
        assignee: 'Dr. Maha',
        task: 'Task 2',
        dueDate: '2024-02-20',
    },
];

function displayTasks(tasksArray) {
    taskList.innerHTML = '';

    for (const task of tasksArray) {
        const taskItem = document.createElement('li');
        taskItem.className = 'task-item';

        const taskContent = document.createElement('div');
        taskContent.textContent = `${task.assignee} - ${task.task}`;
        taskItem.appendChild(taskContent);

        const taskDueDate = document.createElement('div');
        taskDueDate.className = 'task-due-date';
        taskDueDate.textContent = task.dueDate;
        taskItem.appendChild(taskDueDate);

        taskList.appendChild(taskItem);
    }
}

function handleDateFilterChange() {
    const dateFilter = document.getElementById('due-date-filter').value;
    const filteredTasks = tasks.filter(task => task.dueDate === dateFilter);
    displayTasks(filteredTasks);
}

displayTasks(tasks);