<?php
include('config.php');
include('seguranca.php');
$ndiario = $_POST['ndiario'];
$datal = date('Y-m-d');
$tiponota = $_POST['tipo'];
$descricao = $_POST['descricao'];
$peso = $_POST['peso'];
$periodo = $_POST['periodo'];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

if(isset($_POST['matricula']))
{
for($i=0; $i <= ((count($_POST['matricula'])-1)); $i++)
{
$matricula = $_POST['matricula'][$i];
$nota = $_POST['nota'][$i];


$PDO = db_connect();
	$sql="INSERT INTO `$banco`.`$tabela_notas` (`sga_notas_IDDiario`, `sga_notas_Matricula`, `sga_notas_Nota`, `sga_notas_Periodo`, `sga_notas_Descricao`, `sga_notas_Peso`, `sga_notas_DtLancamento`, `sga_notas_Tipo`) VALUES (:ndiario, :matricula, :nota, :periodo, :descricao, :peso, :datal, :tiponota);
	";
	
	$stmt = $PDO->prepare($sql);
	$stmt->BindParam(':ndiario', $ndiario);
	$stmt->BindParam(':matricula', $matricula);
	$stmt->BindParam(':nota', $nota);
	$stmt->BindParam(':periodo', $periodo);
	$stmt->BindParam(':descricao', $descricao);
	$stmt->BindParam(':peso', $peso);
	$stmt->BindParam(':datal', $datal);
	$stmt->BindParam(':tiponota', $tiponota);
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
header('Location:add_notas.php');
?>

?>