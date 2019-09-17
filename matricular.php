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
    <script type="text/javascript" src="Scripts/FuncaoMatricular.js"></script>


</head>

<body>
    <?php
require_once('menu.php');
?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title">
                            <h4>Cadastro de Alunos</h4>
                        </div>

                        <form name="cad_aluno" action="inserir_matricula.php" method="POST">
                            <label class="label-control">Nº Do Diário</label>
                            <select name="ndiario" id="ndiario" type="text" class="form-control col-lg-2">
                                <option name="ndiario" id="ndiario" value="0">Selecione o Diário</option>
                                <?php

// efetua a busca no banco de dados
$PDO = db_connect();
$sql = "SELECT * FROM sga.sga_diario; ";
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

echo"<option name='ndiario' id='ndiario' value='".$row['sga_diario_ID']."'>".$row['sga_diario_Numero']."</option>";

}
?>

                            </select>
                            <br>
                            <table id="products-table" class="table table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Matricula</th>

                                    </tr>
                                    <?php

$sql = "SELECT sga_Aluno_ID as ID, sga_aluno_Matricula as matricula, sga_aluno_Nome as nome FROM $banco.$tabela_aluno ";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$cont = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$cont++;
echo '
<tr>
   <td><input type="checkbox" name="aluno'.$cont.'" value="'.$row['ID'].'"></td> 
   <td>'.$row['nome'].'</td>
     <td>'.$row['matricula'].'</td>

     </tr>';
}
echo '<input style="display:none;" name="controle" value='.$cont.'>';
?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" style="text-align: left;">
                                            <button class="btn btn-large btn-success" type="submit">Adicionar Alunos no
                                                Diário</button>

                                        </td>
                                    </tr>

                                </tfoot>
                            </table>
                        </form>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer">
                            <p>SGCA <?php echo date('Y');?> - © - Todos Direitos Reservados - Desenvolvido By Laider
                                Lucas </p>
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
</body>

</html>