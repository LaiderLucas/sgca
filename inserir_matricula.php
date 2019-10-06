<?php
include('config.php');
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 

date_default_timezone_set('America/Cuiaba');
$dtmatricula = date('Y-m-d');
$ndiario = $_POST['ndiario'];



$PDO = db_connect();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

if(isset($_POST['aluno']))
{
for($i=0; $i <= ((count($_POST['aluno'])-1)); $i++)
{
$aluno = $_POST['aluno'][$i];
echo "$aluno, $i  - <br>";


	$sql="INSERT INTO `$banco`.`$tabela_matricula` (`sga_matricula_Aluno`, `sga_matricula_Diario`, `sga_matricula_dtmatricula`) VALUES 
	(:aluno, :ndiario , :dtmatricula)";
	
    $stmt = $PDO->prepare($sql);
    $stmt->BindParam(':aluno', $aluno);
	$stmt->BindParam(':ndiario', $ndiario);
    $stmt->BindParam(':dtmatricula',$dtmatricula);

	if ($stmt->execute()){
		$_SESSION['sucesso'] = 1;
	}else {
		$_SESSION['sucesso'] = 0;
		$_SESSION['aviso'] = "ERRO AO CADASTRAR ALUNOS!";
		echo"Erro!!";	
		print_r($stmt);
		die;
	}
}
}
}
// volta para a pagina de cadastro do usuário
header('Location:matricular.php');
?>