<?php
include('config.php');
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 

date_default_timezone_set('America/Cuiaba');
$dtmatricula = date('Y-m-d');
$controle = $_POST['controle'];
$ndiario = $_POST['ndiario'];



$PDO = db_connect();

for ($i = 1; $i <= $controle; $i++) {
$m = "aluno".$i;

if($aluno == $_POST[$m])
{
$aluno = $_POST[$m];	



	

	$sql="INSERT INTO `$banco`.`$tabela_matricula` (`sga_matricula_Aluno`, `sga_matricula_Diario`, `sga_matricula_dtmatricula`) VALUES 
	(:aluno, :ndiario , :dtmatricula);

	";
	
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
	die;
	}
}
}



// volta para a pagina de cadastro do usuário
header('Location:matricular.php');
?>