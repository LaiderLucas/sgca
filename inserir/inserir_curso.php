<?php
include('../core/config.php');
include("../core/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 

$nomeCurso = $_POST['nomeCurso'];
$duracao = $_POST['duracao'];
$instituicao = $_POST['instituicao'];
$IDU = base64_decode($_COOKIE['SID']);



$PDO = db_connect();


$sql="INSERT INTO `$banco`.`$tabela_curso` (`sga_curso_Nome`, `sga_curso_Instituicao`, `sga_curso_Duracao`, `sga_curso_IDUser`) VALUES (:nomeCurso, :duracao, :instituicao, :idu);
";

$stmt = $PDO->prepare($sql);
$stmt->BindParam(':nomeCurso', $nomeCurso);
$stmt->BindParam('duracao',$duracao);
$stmt->BindParam(':instituicao', $instituicao);
$stmt->BindParam(':idu', $IDU);


if ($stmt->execute()){
	$_SESSION['sucesso'] = 1;
}else {
	$_SESSION['sucesso'] = 0;
	$_SESSION['aviso'] = "ERRO AO CADASTRAR CURSO!";
	print_r($stmt);	
die;
}
?>
<script>
window.location.href = "http://localhost/teste/pages.php";
</script>