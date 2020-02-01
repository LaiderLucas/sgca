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
                            <h4>Cursos Cadastrados </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome de Curso</th>
                                            <th>Duração (Semestres)</th>
                                            <th>Situação</th>



                                        </tr>
                                    </thead>
                                    <?php
$ID = 0;
$PDO = db_connect();
$IDU = base64_decode($_COOKIE['SID']);
$sql = "SELECT sga_curso_Nome, sga_curso_Duracao FROM $banco.$tabela_curso where sga_curso_IDUser = $IDU;" ;
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {



$ID++;

                                              echo"  <tbody>
                                                    <tr>
                                                        <td>".$ID."</td>
                                                        <td>".$row['sga_curso_Nome']."</td>
                                                        <td>".$row['sga_curso_Duracao']."</td>
                                                       
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