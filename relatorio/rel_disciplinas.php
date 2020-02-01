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
                            <h4>Disciplinas Cadastradas </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th>Nome</th>

                                            <th>Nivel</th>


                                        </tr>
                                    </thead>
                                    <?php
$ID = 0;
$PDO = db_connect();
$IDU = base64_decode($_COOKIE['SID']);
$sql = "SELECT * FROM $banco.$tabela_disciplina where sga_disciplina_IDUser = $IDU;";
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {

$ID++;

                                              echo"  <tbody>
                                                    <tr>
                                                        <td>".$ID."</td>
                                                       
                                                        <td>".$row['sga_disciplina_Nome']."</td>
                                                        <td>".$row['sga_disciplina_Nivel']."</td>
                                                        
                                                       
                                                    </tr>";
 }    
                                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>