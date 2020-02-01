<?php
include('../core/config.php');
include("../core/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 


$ndiario = $_POST['ndiario'];
$disciplina = $_POST['disciplina'];
$turma = $_POST['turma'];
$IDU = base64_decode($_COOKIE['SID']);


$PDO = db_connect();


$sql="INSERT INTO $banco.$tabela_diario (`sga_diario_Numero`, `sga_diario_Disciplina`, `sga_diario_Turma`, `sga_diario_IDUser`) VALUES (:ndiario, :disciplina, :turma, :idu);";

$stmt = $PDO->prepare($sql);
$stmt->BindParam(':ndiario', $ndiario);
$stmt->BindParam(':disciplina',$disciplina);
$stmt->BindParam(':turma', $turma);
$stmt->BindParam(':idu', $IDU);

if ($stmt->execute()){
	$_SESSION['sucesso'] = 1;
}else {
	$_SESSION['sucesso'] = 0;
	$_SESSION['aviso'] = "ERRO AO CADASTRAR DIARIO!";
	print_r($stmt);	
die;
}
?>
<script>
window.location.href = "http://localhost/teste/pages.php";
</script>