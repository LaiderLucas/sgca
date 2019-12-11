<?php
include('../core/config.php');
include("../core/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 
// inicia a session

$nomeDisciplina = $_POST['nomeDisciplina'];
$nivel = $_POST['nivel'];
$IDU = base64_decode($_COOKIE['SID']);



$PDO = db_connect();


$sql="INSERT INTO `$banco`.`$tabela_disciplina` (`sga_disciplina_Nome`, `sga_disciplina_Nivel`, `sga_disciplina_IDUser`) VALUES (:nomeDisciplina, :nivel, :idu);
";

$stmt = $PDO->prepare($sql);
$stmt->BindParam(':nomeDisciplina', $nomeDisciplina);
$stmt->BindParam(':nivel',$nivel);
$stmt->BindParam(':idu', $IDU);


if ($stmt->execute()){
	$_SESSION['sucesso'] = 1;
}else {
	$_SESSION['sucesso'] = 0;
	$_SESSION['aviso'] = "ERRO AO CADASTRAR CURSO!";
	print_r($stmt);	
die;
}

// volta para a pagina de cadastro do usuário
header('Location:../adicionar/add_disciplinas.php');
