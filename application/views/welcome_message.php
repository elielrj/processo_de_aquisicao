<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if(isset($_FILES['arquivo'])){

	var_dump($_FILES['arquivo']); 

	$arquivo = $_FILES['arquivo'];


	

	if($arquivo['error'])
	{
		die('Falha ao enviar o arquivo!');
	} 
	else if($arquivo['size'] > (10 * 1024 * 1024))
	{
		die("Arquivo maior que o permitido! Máximo de 10 Mb");
	}

	$pasta = "arquivos/";

	$nomeDoArquivo = $arquivo['name'];
	
	$novoNomeDoArquivo = uniqid();
	
	$extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));


	if($extensao != "pdf")
	{
		die('Tipo de arquivo não aceito!');
	}else
	{
		$enviado = move_uploaded_file(
				$arquivo["tmp_name"], $pasta . $nomeDoArquivo . "." . $extensao
		);

		if($enviado){
			echo "<a href='" . $novoNomeDoArquivo . $extensao ."'><label>Visualizar</label></a>";
		}else{
			echo "Falhou o carregamento!";
		}
	}

	


}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Processos de Aquisições</title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data" action="">
		<p>
			<label for="">Selecione</label>
			<input name="arquivo" type="file">
		</p>
		<button name="upload" type="submit">Enviar</button>
	</form>
</body>
</html>
