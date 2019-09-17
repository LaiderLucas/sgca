<?php
include('config.php');
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 

date_default_timezone_set('America/Cuiaba');
$dtmatricula = $_POST['dtchamada'];
$controle = $_POST['controle'];
$ndiario = $_POST['ndiario'];



$PDO = db_connect();

for ($i = 1; $i <= $controle; $i++) {
$m = "matricula".$i;
$n = "nfaltas".$i
	
$matricula = $_POST[$m];
$nfaltas = $_POST[$n];


	

	$sql="INSERT INTO $banco.$tabela_presencas (`sga_presencas_data`, `sga_presencas_Matricula`, `sga_presencas_Diario`, `sga_presencas_nFaltas`) VALUES ('2019-06-04', '20181001215251545', '1', '1');

	";
	
	$stmt = $PDO->prepare($sql);
	$stmt->BindParam(':dtchamada',$dtchamada);
    $stmt->BindParam(':matricula', $matricula);
	$stmt->BindParam(':ndiario', $ndiario);
	$stmt->BindParam(':nfaltas',$nfaltas);

	if ($stmt->execute()){
		$_SESSION['sucesso'] = 1;
	}else {
		$_SESSION['sucesso'] = 0;
		$_SESSION['aviso'] = "ERRO AO CADASTRAR ALUNOS!";
        echo"Erro!!";	
	die;
    }
}



// volta para a pagina de cadastro do usuário
header('Location:add_presencas.php');
?>