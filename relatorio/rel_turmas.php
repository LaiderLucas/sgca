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
                            <h4>Turmas Cadastradas </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th>Série/Semestre</th>

                                            <th>Ano/Semestre</th>
                                            <th>Curso</th>
                                            <th>Turno</th>
                                            <th>Ano Inicio</th>

                                        </tr>
                                    </thead>
                                    <?php
$ID = 0;
$PDO = db_connect();
$IDU = base64_decode($_COOKIE['SID']);
$sql = "SELECT $tabela_turma.sga_turma_Turno 
AS Turno, $tabela_turma.sga_turma_SerieAno AS ano,$tabela_turma.sga_turma_ano_semestre AS ano_semestre, $tabela_turma.sga_turma_AnoInicio 
AS anoInicio, $tabela_curso.sga_curso_Nome AS nomeCurso
FROM $tabela_turma
inner join $tabela_curso on $tabela_turma.sga_turma_Curso = sga_curso_ID where $tabela_turma.sga_turma_IDUser = $IDU
order by anoInicio desc;" ;
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {



$ID++;

                                              echo"  <tbody>
                                                    <tr>
                                                        <td>".$ID."</td>
                                                       
                                                        <td>".$row['ano']."º</td>
                                                        <td>".$row['ano_semestre']."</td>
                                                        <td>".$row['nomeCurso']."</td>
                                                        <td>".$row['Turno']."</td>
                                                        <td>".$row['anoInicio']."</td>
                                                       
                                                    </tr>";
 }    
                                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>