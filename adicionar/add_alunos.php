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
        <link href="assets/css/lib/helper.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <script type="text/javascript" src="Scripts/jQuery.js"></script>
    <script type="text/javascript" src="Scripts/funcao.js"></script> 
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
                                    <h4>Cadastro de Alunos</h4>
                                       </div>

                                       <form name="cad_aluno" action="inserir/inserir_aluno.php" method="POST">                                 
 <table id="products-table" class="table table-hover table-bordered">
  <tbody>
        <tr>
            <th>Matricula</th>
            <th>Nome</th>
            <th>Instituição</th>
            <th class="actions">Ações</th>
        </tr>

        <tr>
             <td style="display:none;" ><input value='1' name="controle" ></td>
             <td><input class="col-sm-10" type="number" name="matricula1" required ></td>
             <td><input class="col-sm-12" type="text" name="nome1" required></td>
             <td><input type="checkbox" name="instituicao1" value='1' checked = "checked" required>IFMT - PL/FO</td> 
             <td class="actions">
                 <button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button">Remover</button>
            </td>
        </tr>
    </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="text-align: left;">
                    <button class="btn btn-large btn-success" onclick="AddTableRow(this)" type="button">Adicionar Aluno</button>
                    <button class="btn btn-large btn-info" type="submit">Cadastrar Alunos</button>
    
                </td>
            </tr>
        </tfoot>
 </table>
</form>

</div>
    </div>

<!-- Rodepé -->
<?php
include('core/footer.php');
?>
<!-- Fim --> 

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
</body>

</html>