<?php

include("config.php");
$IDU = base64_decode($_COOKIE['SID']);
$id = $_POST["id"];
$PDO = db_connect();
$sql = "SELECT $tabela_turma.sga_turma_ID AS turma_ID , $tabela_turma.sga_turma_SerieAno AS SerieAno , $tabela_turma.sga_turma_ano_semestre AS semestre,
$tabela_curso.sga_curso_Nome AS curso_Nome, $tabela_turma.sga_turma_Turno AS turno FROM $tabela_diario 
inner join $tabela_turma on $tabela_turma.sga_turma_ID = $tabela_diario.sga_diario_Turma
inner join $tabela_curso on $tabela_turma.sga_turma_Curso = $tabela_curso.sga_curso_ID
where $tabela_diario.sga_diario_ID = $id and $tabela_diario.sga_diario_IDUser = $IDU;";
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     echo "<option value='" . $row["turma_ID"] . "'>" . htmlentities($row["SerieAno"]) . "º - " . $row['semestre'] . " - " . $row['curso_Nome'] . " - " . $row['turno'] . "</option>\n";
}
