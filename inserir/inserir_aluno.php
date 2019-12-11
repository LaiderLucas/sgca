<?php
include('../core/config.php');
include("../core/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 


$controle = $_POST['controle'];




$PDO = db_connect();




for ($i = 1; $i <= $controle; $i++) {
$m = "matricula".$i;
$n = "nome".$i;
$in = "instituicao".$i;

	
$matricula = $_POST[$m];
$nome = $_POST[$n];
$instituicao = $_POST[$in];
	

	$sql="INSERT INTO `$banco`.`$tabela_aluno` (`sga_aluno_Matricula`, `sga_aluno_Nome`, `sga_aluno_instituicao`) VALUES 
	(:matricula, :nome, :instituicao);
	";
	
	$stmt = $PDO->prepare($sql);
	$stmt->BindParam(':matricula', $matricula);
	$stmt->BindParam(':nome',$nome);
	$stmt->BindParam(':instituicao', $instituicao);
	if ($stmt->execute()){
		$_SESSION['sucesso'] = 1;
	}else {
		$_SESSION['sucesso'] = 0;
		$_SESSION['aviso'] = "ERRO AO CADASTRAR ALUNOS!";
		print_r($stmt);	
	die;
	}
}






// volta para a pagina de cadastro do usuário
header('Location:../adicionar/add_alunos.php');
?>