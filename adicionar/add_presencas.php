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
        <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet">
        <link href="assets/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet">
        <link href="assets/css/lib/helper.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body>
<?php
include('core/config.php');
require_once('core/menu.php');
?>
    
        <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Registro de Presença - Diário: 1233 - Data: 31/05/2019  </h4>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form id="lanca_presenca" action="inserir/inserir_presenca.php" method="GET">
                                        <table class="jsgrid-table">
                                            <thead>
                                                <tr class ="jsgrid-header-row">
                                                <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 20px;">Nº</th>
                                                    <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 50px;">Matricula</th>
                                                    <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 150px;">Nome Completo</th>
                                                     <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 30px;">Nº de Faltas</th>
                                                    <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 30px;">31/05/2019</th>
                                                    <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 30px;">Situação</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
 <?php
 $PDO = db_connect();
$cont = 1; 
 $sql = "SELECT sga_matricula.sga_matricula_Aluno as matricula, sga_aluno.sga_aluno_Nome
 from sga_matricula
 inner join sga_aluno on sga_aluno.sga_aluno_Matricula = sga_matricula.sga_matricula_Aluno;";
 $stmt = $PDO->prepare($sql);
 $stmt->execute();

 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 $controle = $cont++;    
                                               
echo'
                                                <tr >
                                                
                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">'.$controle.'</td>
                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                <input name="matricula'.$controle.'" id="matricula'.$controle.'" value='.$row['matricula'].' style="display:none;">
                                                '.$row['matricula'].'</td>
                                                <td class="jsgrid-cell" style="width: 50px;">'.$row['sga_aluno_Nome'].'</td>
                                                <td class="jsgrid-cell " style="width: 50px;">1</td>
                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;"><input name="nfaltas'.$controle.'" id="nfaltas'.$controle.'" type="number" class=" form-control input-sm"> </td>
                                                <td class="jsgrid-cell " style="width: 50px;"><span class="badge badge-success">Matriculado</span></td>
                                                </tr>';

                                            }
echo '<input name="controle" id="controle" value='.$controle.' style="display:none;">';
?>                                           

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
 <button type="submit">Teste</button>
 </form>                       
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
        <script src="assets/js/lib/jquery.min.js"></script>
        <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="assets/js/lib/menubar/sidebar.js"></script>
        <script src="assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="assets/js/lib/bootstrap.min.js"></script>

        <!-- bootstrap -->

        <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
        <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>

        <script src="assets/js/lib/morris-chart/raphael-min.js"></script>
        <script src="assets/js/lib/morris-chart/morris.js"></script>
        <script src="assets/js/lib/morris-chart/morris-init.js"></script>

        

        <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
        <script src="assets/js/lib/weather/weather-init.js"></script>
        <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
        <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
        <script src="assets/js/scripts.js"></script>
        <!-- scripit init-->


        <!-- JS Grid Scripts Start-->
    <script src="assets/js/lib/jsgrid/db.js"></script>
    <script src="assets/js/lib/jsgrid/jsgrid.core.js"></script>
    <script src="assets/js/lib/jsgrid/jsgrid.load-indicator.js"></script>
    <script src="assets/js/lib/jsgrid/jsgrid.load-strategies.js"></script>
    <script src="assets/js/lib/jsgrid/jsgrid.sort-strategies.js"></script>
    <script src="assets/js/lib/jsgrid/jsgrid.field.js"></script>
    <script src="assets/js/lib/jsgrid/fields/jsgrid.field.text.js"></script>
    <script src="assets/js/lib/jsgrid/fields/jsgrid.field.number.js"></script>
    <script src="assets/js/lib/jsgrid/fields/jsgrid.field.select.js"></script>
    <script src="assets/js/lib/jsgrid/fields/jsgrid.field.checkbox.js"></script>
    <script src="assets/js/lib/jsgrid/fields/jsgrid.field.control.js"></script>
    <script src="assets/js/lib/jsgrid/jsgrid-init.js"></script>
    <!-- JS Grid Scripts End-->

    </body>

</html>
