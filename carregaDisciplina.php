<?php 


include("config.php");
$IDU = base64_decode($_COOKIE['SID']);
$id = $_POST["id"];
$PDO = db_connect();
$sql = "SELECT  $tabela_disciplina.sga_disciplina_ID AS sga_disciplina_ID ,$tabela_disciplina.sga_disciplina_Nome AS sga_disciplina_Nome FROM $tabela_diario 
inner join $tabela_disciplina on $tabela_disciplina.sga_disciplina_ID = $tabela_diario.sga_diario_Disciplina
where $tabela_diario.sga_diario_ID = $id and $tabela_diario.sga_diario_IDUser = $IDU";
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
     echo "<option value='".$row["sga_disciplina_ID"]."'>".htmlentities($row["sga_disciplina_Nome"])."</option>\n";
}
