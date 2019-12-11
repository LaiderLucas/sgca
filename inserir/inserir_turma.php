<?php
include('../core/config.php');
include("../core/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 


$serie_ano = $_POST['serie_ano'];
$ano_semestre = $_POST['ano_semestre'];
$ano_inicio = $_POST['ano_inicio'];
$turno = $_POST['turno'];
$curso = $_POST['curso'];
$instituicao = $_POST['instituicao'];
$IDU = base64_decode($_COOKIE['SID']);


$PDO = db_connect();


$sql="INSERT INTO `$banco`.`$tabela_turma` (`sga_turma_SerieAno`, `sga_turma_Curso`, `sga_turma_Turno`, `sga_turma_AnoInicio`, `sga_turma_instituicao`, `sga_turma_ano_semestre`, `sga_turma_IDUser`) 
VALUES (:serie_ano, :curso, :turno, :ano_inicio, :instituicao, :ano_semestre, :idu)
;
";

$stmt = $PDO->prepare($sql);
$stmt->BindParam(':serie_ano', $serie_ano);
$stmt->BindParam(':curso',$curso);
$stmt->BindParam(':turno', $turno);
$stmt->BindParam(':ano_inicio', $ano_inicio);
$stmt->BindParam(':instituicao', $instituicao);
$stmt->BindParam(':ano_semestre', $ano_semestre);
$stmt->BindParam(':idu', $IDU);

if ($stmt->execute()){
	$_SESSION['sucesso'] = 1;
}else {
	$_SESSION['sucesso'] = 0;
	$_SESSION['aviso'] = "ERRO AO CADASTRAR TURMA!";
	print_r($stmt);	
die;
}


// volta para a pagina de cadastro do usuário
header('Location:../adicionar/add_turmas.php');
?>