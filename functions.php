<?php 
date_default_timezone_set('America/Sao_Paulo');

define('TASKS_FILE', 'tasks.json');

function addTask($taskDescription) {    
    $tasks = loadTasks();

    $newTask = [
        'id'=> count($tasks) + 1,
        'task' => $taskDescription,
        'status' => 'pendente',
        'create_at' => date('d-m-Y H:i:s'),
        'update_at' => date('d-m-Y H:i:s')
    ];

    $tasks[] = $newTask;
    saveTasks($tasks);

    echo "Tarefa adicionada com sucesso: {$taskDescription}\n";
}

function listTasks() {
    $tasks = loadTasks();

    if (empty($tasks)) {
        echo "Nenhuma tarefa encontrada.\n";
    } else {
        foreach ($tasks as $task) {
            echo "[{$task['id']}] - {$task['task']} ({$task['status']}) - {$task['create_at']}\n";
        }
    }
}

function markTaskDone($taskId) {
        $tasks = loadTasks();

        foreach ($tasks as &$task) {
            if ($task['id'] === $taskId) {
                $task['status'] = 'concluída';
                saveTasks($tasks);
                echo "Tarefa ID {$taskId} marcada como concluída.\n";
                return;
            }
        }

        echo "Tarefa com ID {$taskId} não encontrada.\n";
    }

function loadTasks() {
    if (!file_exists(TASKS_FILE) || filesize(TASKS_FILE) == 0) {
        return [];
    }
    return json_decode(file_get_contents(TASKS_FILE), true) ?? [];
}

function listDone() {
    $tasks = loadTasks();

    $doneTasks = array_filter($tasks, function($task) {
        return $task['status'] === 'concluída';
    });

    if (empty($doneTasks)) {
        echo "Nenhuma tarefa concluída encontrada.\n";
    } else {
        foreach ($doneTasks as $task) {
            echo "[{$task['id']}] - {$task['task']} ({$task['status']}) - {$task['create_at']}\n";
        }
    }

}

function saveTasks($tasks) {
    file_put_contents(TASKS_FILE, json_encode($tasks, JSON_PRETTY_PRINT));
}

function delete($taskId) {
    $tasks = loadTasks();
    $taskFound = false;

    foreach ($tasks as $key => $task) {
        if ($task['id'] === $taskId) {
            unset($tasks[$key]);
            $taskFound = true;
            break;
        }
    }

    if ($taskFound) {
        saveTasks($tasks);
        echo "Tarefa com ID {$taskId} excluída com sucesso.\n" ;
    } else {
        echo "Tarefa com ID {$taskId} não encontrada.\n";
    }

}

?>