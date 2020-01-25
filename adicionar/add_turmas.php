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
                                    <h4>Cadastro de Turmas</h4>
                                    
                                </div>
                                <form name="cad_turma" action="inserir/inserir_turma.php" method="GET">
        <fieldset>
          <!-- Text input-->
          <div class="form-group">
<label class="col-sm-2 control-label">Ano/Semestre</label>
<div class="col-sm-10">
  <input name="serie_ano" id="serie_ano"  class="col-sm-1" type="number" min=1 max=15 required placeholder = "1"> &nbsp;&nbsp;&nbsp;
  <input type="radio" id="ano_semestre" name="ano_semestre" Value = "Ano" > Ano &nbsp;&nbsp;&nbsp;
  <input type="radio" id="ano_semestre" name="ano_semestre" value = "Semestre" > Semestre 
    </div>
   </div>
          
  <!-- Select -->
          <div class="form-group">
            <label class="control-label" for="disciplina">Truno</label>
            <div class="col-sm-10">
            <input type="radio" id="turno" name="turno" value="Matutino" > Matutino &nbsp;&nbsp;&nbsp;
            <input type="radio" id="turno" name="turno" Value ="Vespertino" > Vespertino &nbsp;&nbsp;&nbsp;
            <input type="radio" id="turno" name="turno" Value = "Noturno" > Noturno &nbsp;&nbsp;&nbsp;
</div> 
</div>

<div class="form-group">
            <label class="control-label" for="ano_inicio">Ano de Inicio</label>
            <div class="col-sm-10">
            <input class="col-sm-2" type="number" id="ano_inicio" name="ano_inicio" min=2019 required placeholder="2019" > 
</div> 
</div>

          <!-- Lista de Turmas -->
          <div class="form-group">
            <label class=" control-label" for="curso">Curso</label>
            <div class="col-sm-10">
              <select id="curso" name="curso" class="form-control">
    <?php 
    $IDU = base64_decode($_COOKIE['SID']);
    $PDO = db_connect();
$sql = "SELECT sga_curso_ID, sga_curso_Nome FROM $banco.$tabela_curso where sga_curso_IDUser = $IDU ;
;";
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
     echo "<option value='".$row["sga_curso_ID"]."'>".htmlentities($row["sga_curso_Nome"])."</option>\n";
}

    ?>
              </select>
</div>
          </div> 
          
          <div class="form-group">
            <label class="control-label" for="instituicao">Instituição</label>
            <div class="col-sm-10">
            <input type="radio" id="instituicao" name="instituicao" value="1" checked="checked" > IFMT - CAMPUS PONTES E LACERDA/FRONTEIRA OESTE &nbsp;&nbsp;&nbsp;
            
</div> 
</div>
          

        

        </fieldset>
         <div class="form-group">
            <div>
            <button class="btn btn-success btn-large m-b-10 m-l-5" type="submit">Cadastrar Turma</button>
               <button  class="btn btn-danger btn-large m-b-10 m-l-5" onClick="JavaScript: window.history.back();" >Voltar</button>
            </div>
        </div>
      </form>   
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

</div>
</div>

</body>

</html>