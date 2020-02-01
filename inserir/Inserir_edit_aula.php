<?php
include('../core/config.php');
include("../core/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 
// inicia a session
session_start();
//seta a timezone para pegar data e hora
date_default_timezone_set('America/Cuiaba');
$dt_edit = date('Y-m-d');
$ndiario = $_POST['ndiario'];
$dt_aulas = $_POST['dt_aulas'];
$inicio_aula = $_POST['inicio_aula'];
$termino_aula = $_POST['termino_aula'];
$qtd_aulas = $_POST['qtd_aulas'];
$obs = $_POST['obs'];
$cont_min = $_POST['cont_min'];
$planoAula = $_POST['planoAula'];
$atividade = $_POST['atividade'];
$materialAula = $_POST['materialAula'];
$t = $_POST['t'];
$IDU = base64_decode($_COOKIE['SID']);
$IDA = $_POST['ida'];
//unset($_COOKIE['ida']);

$dtaulas = implode('-', array_reverse(explode('/', $dt_aulas)));

$PDO = db_connect();


$sql= "UPDATE $banco.$tabela_aulas SET `sga_aulas_NDiario`=:ndiario, `sga_aulas_qtdAulas`=:qtd_aulas, `sga_aulas_Data`=:dtaulas, `sga_aulas_HoraI`=:inicio_aula, `sga_aulas_HoraT`=:termino_aula, `sga_aulas_Obs`=:obs, `sga_aulas_Conteudo`=:cont_min, `sga_aulas_planoAula`=:planoAula, `sga_aulas_material_aula`=:materialAula, `sga_aulas_atividade`=:atividade, `sga_aulas_dtEdicao`=:dt_edit, `sga_aulas_IDUserEdit`=:IDU WHERE `sga_aulas_ID` = $IDA;
";

$stmt = $PDO->prepare($sql);
$stmt->execute(array(
':ndiario' => $ndiario,
':qtd_aulas' => $qtd_aulas,
':dtaulas' => $dtaulas, 
':inicio_aula' => $inicio_aula, 
':termino_aula' => $termino_aula,
':obs' => $obs, 
':cont_min' => $cont_min, 
':planoAula' => $planoAula, 
':materialAula' => $materialAula, 
':atividade' => $atividade, 
':dt_edit' => $dt_edit, 
':IDU' => $IDU));


if ($t > 0){
	$dt_trocauala=$_POST['dt_trocauala'];
	$inicioT=$_POST['inicioT'];
	$fimT=$_POST['fimT'];
	$dt_repaula=$_POST['dt_repaula'];
	$inicioR=$_POST['inicioR'];
    $fimR=$_POST['fimR'];
    $nomeProfessor=$_POST['nomeProfessor'];
	$just_troca=$_POST['just_troca'];
	$dttrocauala = implode('-', array_reverse(explode('/', $dt_trocauala)));
	$dtrepaula = implode('-', array_reverse(explode('/', $dt_repaula)));
	
	
$sql1 = "UPDATE $banco.$tabela_trocas SET  `sga_trocas_DtTroca`=:dttrocauala, `sga_trocas_HrTroca_I`=:inicioT, `sga_trocas_HrTroca_T`=:fimT, `sga_trocas_DtReposicao`=:dtrepaula, `sga_trocas_HrReposicao_I`=:inicioR, `sga_trocas_HrReposicao_T`=:fimR, `sga_trocas_Justificativa`=:just_troca, `sga_trocas_professor`=:nomeProfessor WHERE `sga_trocas_IDTroca`=$t;";

$stmt1 = $PDO->prepare($sql1);
$stmt1->execute(array(
':dttrocauala' => $dttrocauala,
':inicioT' => $inicioT,
':fimT' => $fimT, 
':dtrepaula' => $dtrepaula, 
':inicioR' => $inicioR,
':fimR' => $fimR, 
':just_troca' => $just_troca, 
':nomeProfessor' => $nomeProfessor
));

}

?>
<script>
window.location.href = "http://localhost/teste/pages.php";
</script>