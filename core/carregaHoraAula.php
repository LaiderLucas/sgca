<?php 


include("config.php");
$IDU = base64_decode($_COOKIE['SID']);
$id = $_POST["id"];
$PDO = db_connect();
$sql = "SELECT  $tabela_horarioaula.sga_horarioAula_HoraI AS horaI, $tabela_horarioaula.sga_horarioAula_HoraT AS horaT, $tabela_horarioaula.sga_horarioAula_NAulas AS naulas FROM $tabela_diario 
inner join $tabela_horarioaula on $tabela_horarioaula.sga_horarioAula_ID = $tabela_diario.sga_diario_HorarioAula
where $tabela_diario.sga_diario_ID = $id and $tabela_diario.sga_diario_IDUser = $IDU ;";
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
     echo "bbakdsh";
}
