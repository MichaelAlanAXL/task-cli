<?php 

require_once 'functions.php';

$arguments = $_SERVER['argv'];

if (isset($arguments[1])) {
	$command = $arguments[1];

	switch ($command) {
		case 'add':
			if (isset($arguments[2])) {
				addTask($arguments[2]);
			} else {
				echo "Erro: Informe uma descrição para a tarefa.\n";
			}
			break;

		case 'list':
			if (isset($arguments[2]) && $arguments[2] === 'done') {
				listDone();
			} else {
				listTasks();
			}			
			break;

		case 'done':
			if (isset($arguments[2])) {
				$taskId = (int)$arguments[2];
				markTaskDone($taskId);
			} else {
				echo "Erro: Informe o ID da tarefa a ser concluída.\n";
			}
			break;

		case 'delete':
			if (isset($arguments[2])) {
				$taskId = (int)$arguments[2];
				delete($taskId);
			} else {
				echo "ID da tarefa não fornecido.\n";
			}
			break;

		default:
			echo "Comando não reconhecido. Use: add, list, done, delete\n";
			break;
	}
} else {
	echo "Uso: php todolist.php [comando] [argumentos]\n";
}

?>