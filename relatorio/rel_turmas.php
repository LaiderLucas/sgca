<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SGCA - SISTEMA DE GESTÃO E CONTROLE DE AULAS</title>

        <!-- ================= Favicon ================== -->
        <!-- Standard -->
        <link rel="shortcut icon" href="">
        <!-- Retina iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="144x144" href="">
        <!-- Retina iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="114x114" href="">
        <!-- Standard iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="72x72" href="">
        <!-- Standard iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="57x57" href="">

        <!-- Styles -->
        <link href="../assets/css/lib/weather-icons.css" rel="stylesheet" />
        <link href="../assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="../assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
        <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">

        <link href="../assets/css/lib/helper.css" rel="stylesheet">
        <link href="../assets/css/style.css" rel="stylesheet">
    </head>

    <body>
<?php
include('../core/config.php');
require_once('../core/menu.php');
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="footer">
                                <p>SGCA <?php echo date('Y');?> - © - Todos Direitos Reservados - Desenvolvido By Laider Lucas </p>
                                </div>
                            </div>
                        </div>                 
                </div>
            </div>
        </div>
        
        

        <!-- jquery vendor -->
        <script src="../assets/js/lib/jquery.min.js"></script>
        <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="../assets/js/lib/menubar/sidebar.js"></script>
        <script src="../assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="../assets/js/lib/bootstrap.min.js"></script>

        <!-- bootstrap -->

        <script src="../assets/js/lib/circle-progress/circle-progress.min.js"></script>
        <script src="../assets/js/lib/circle-progress/circle-progress-init.js"></script>

        <script src="../assets/js/lib/morris-chart/raphael-min.js"></script>
        <script src="../assets/js/lib/morris-chart/morris.js"></script>
        <script src="../assets/js/lib/morris-chart/morris-init.js"></script>

        

        <script src="../assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
        <script src="../assets/js/lib/weather/weather-init.js"></script>
        <script src="../assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
        <script src="../assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
        <script src="../assets/js/scripts.js"></script>
        <!-- scripit init-->

    </body>

</html>
