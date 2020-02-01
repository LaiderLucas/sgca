<body>
    <?php
require_once('core/menu.php');
?>
    <!-- /# sidebar -->
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">

                <!-- Tabela -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title">
                            <h4>Diários Cadastrados </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nº Diario</th>
                                            <th>Disciplina</th>
                                            <th>Turma</th>

                                            <th>Situação</th>


                                        </tr>
                                    </thead>
                                    <?php
$ID = 0;
$PDO = db_connect();
$IDU = base64_decode($_COOKIE['SID']);
$sql = "SELECT $tabela_diario.sga_diario_Numero AS ndiario, $tabela_disciplina.sga_disciplina_Nome AS disciplina ,$tabela_turma.sga_turma_Turno 
AS Turno, $tabela_turma.sga_turma_SerieAno AS ano,$tabela_turma.sga_turma_ano_semestre AS ano_semestre, $tabela_turma.sga_turma_AnoInicio 
AS anoInicio, $tabela_curso.sga_curso_Nome AS nomeCurso
FROM $tabela_diario
inner join $tabela_disciplina on $tabela_disciplina.sga_disciplina_ID = $tabela_diario.sga_diario_Disciplina
inner join $tabela_turma on $tabela_turma.sga_turma_ID = $tabela_diario.sga_diario_Turma
inner join $tabela_curso on $tabela_turma.sga_turma_Curso = sga_curso_ID where $tabela_diario.sga_diario_IDUser = $IDU;" ;
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {



$ID++;

                                              echo"  <tbody>
                                                    <tr>
                                                        <td>".$ID."</td>
                                                        <td>".$row['ndiario']."</td>
                                                        <td>".$row['disciplina']."</td>
                                                        <td>".$row['ano']."º - ".$row['ano_semestre']." - ".$row['nomeCurso']." - ".$row['anoInicio']."</td>
                                                        <td><span class='btn btn-success btn-rounded m-b-10 m-l-5'>Ativo</span></td>
                                                       
                                                    </tr>";
 }    
                                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
