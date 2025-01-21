<?php 

// Pega os dados passados no terminal
$arguments = $_SERVER['argv'];

// Verificação
if (isset($arguments[1])) {
	$command = $arguments[1];

	if ($command === 'hello') {
		echo "Hello, World!\n";
	} else {
		echo "Comando não reconhecido. Tente: php todolist.php hello\n";
	}
} else {
	echo "Nenhum comando fornecido. Tente: php todolist.php hello\n";
}





 ?>