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
  <script type="text/javascript" src="jQuery.js"></script>
  <style>
    .col-sm-0 {
      -ms-flex: 0 0 10%;
      flex: 0 0 10%;
      max-width: 10%;

      min-height: 1px;
      padding-right: 15px;
      padding-left: 15px
    }
  </style>

  <script type="text/javascript">
    function mascaraData(campo, e) {
      var kC = (document.all) ? event.keyCode : e.keyCode;
      var data = campo.value;

      if (kC != 8 && kC != 46) {
        if (data.length == 2) {
          campo.value = data += '/';
        } else if (data.length == 5) {
          campo.value = data += '/';
        } else
          campo.value = data;
      }
    }



    function getValor(valor) {

      $("#disciplina").html("<option value='0'>Carregando...</option>");
      setTimeout(function() {
        $("#disciplina").load("carregaDisciplina.php", {
          id: valor
        })
      }, 250);
      $("#turma").html("<option value='0'>Carregando...</option>");
      setTimeout(function() {
        $("#turma").load("carregaTurma.php", {
          id: valor
        })
      }, 250);
    };


    function getValor11(valor) {
      var resultado = document.getElementById('dt_aulas');

      a = $("#dt_aulas").load("carregaHoraAula.php", {
        id: valor
      });


      $("#dt_aulas").html(resultado.value = a);


    }
  </script>

</head>

<body>
  <?php
  include('config.php');
  require_once('menu.php');

  ?>
  <?php
  $IDA = $_POST["IDAula"];
  $PDO = db_connect();
  $IDU = base64_decode($_COOKIE['SID']);
  $sql = "SELECT $tabela_aulas.sga_aulas_ID AS IDaula, $tabela_aulas.sga_aulas_qtdAulas AS qtdaulas, 
$tabela_aulas.sga_aulas_Data AS dataAula, $tabela_aulas.sga_aulas_HoraI AS horaI, $tabela_aulas.sga_aulas_HoraT AS horaT, 
$tabela_aulas.sga_aulas_Obs AS obs, $tabela_aulas.sga_aulas_Conteudo AS conteudo, $tabela_aulas.sga_aulas_IDTroca,
$tabela_diario.sga_diario_Disciplina AS disciplina, $tabela_diario.sga_diario_Turma AS turma, $tabela_diario.sga_diario_Numero AS diario,
$tabela_turma.sga_turma_Turno AS Turno, $tabela_turma.sga_turma_SerieAno AS ano,$tabela_turma.sga_turma_ano_semestre AS ano_semestre, $tabela_turma.sga_turma_AnoInicio AS anoInicio,
$tabela_curso.sga_curso_Nome AS nomeCurso, $tabela_aulas.sga_aulas_Obs AS obs, $tabela_aulas.sga_aulas_planoAula AS planoAula, $tabela_aulas.sga_aulas_material_aula AS material_aula, $tabela_aulas.sga_aulas_atividade AS atividades,
$tabela_disciplina.sga_disciplina_Nome AS nomeDisciplina
FROM $tabela_aulas
INNER JOIN $tabela_diario ON $tabela_diario.sga_diario_ID = $tabela_aulas.sga_aulas_NDiario
INNER JOIN $tabela_turma ON sga_turma_ID = $tabela_diario.sga_diario_Turma
INNER JOIN $tabela_curso ON $tabela_curso.sga_curso_ID = $tabela_turma.sga_turma_Curso
INNER JOIN $tabela_disciplina ON $tabela_disciplina.sga_disciplina_ID = $tabela_diario.sga_diario_Disciplina
where sga_aulas_IDUser = $IDU and sga_aulas_ID = $IDA";
  $stmt = $PDO->prepare($sql);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $data = date('d/m/Y', strtotime($row['dataAula']));


  if ($row['sga_aulas_IDTroca'] != "") {
    $query0 = "SELECT * from $tabela_trocas  where sga_trocas_IDAula = $IDA";
    $stmt0 = $PDO->prepare($query0);
    $stmt0->execute();
    $row0 = $stmt0->fetch(PDO::FETCH_ASSOC);
    if ($row0['sga_trocas_DtTroca'] == "") {
      $dataT = "";
    } else {
      $dataT = date('d/m/Y', strtotime($row0['sga_trocas_DtTroca']));
    }
    if ($row0['sga_trocas_DtTroca'] == "") {
      $dataR = "";
    } else {

      $dataR = date('d/m/Y', strtotime($row0['sga_trocas_DtReposicao']));
    }
    $t = $row0['sga_trocas_IDTroca'];
    $exibir = "block";
  } else {
    $exibir = "none";
    $t = 0;
  }

  ?>
  <div class="content-wrap">
    <div class="main">
      <div class="container-fluid">
        <div class="col-lg-12">
          <div class="card">
            <form name="editaaula" action="edit_aula.php" method="post">
              <div class="card-title">
                <h4>Edição de Aulas - ID <?php echo $IDA . " - Diario = " . $row['diario']; ?> </h4>
                <input name='ida' id='ida' value="<?php echo $IDA; ?>" readonly style='display:none;' class="form-control input-sm col-sm-0">
                <input name='t' id='t' value="<?php echo $t; ?>" readonly style='display:none;' class="form-control input-sm col-sm-0">

              </div>

              <fieldset>
                <div class="form-group">
                  <br>
                  <div id="dvConteudo" style='display:<?php echo $exibir ?>;'>
                    <br>
                    <label for='dt_trocaaula'>Data da Troca da Aula: </label>
                    <input name="dt_trocauala" id="dt_trocaaula" class="col-sm-0" onkeypress="mascaraData( this, event )" maxlength="10" value="<?php echo $dataT; ?>">
                    <label for=inicioT>Hora de Inicio: </label>
                    <input name="inicioT" id="inicioT" class="col-sm-0" type=time value="<?php echo $row0['sga_trocas_HrTroca_I']; ?>">
                    <label for=fimT>Hora de Término: </label>
                    <input name="fimT" id="fimT" class="col-sm-0" type=time value="<?php echo $row0['sga_trocas_HrTroca_T']; ?>"> &nbsp &nbsp &nbsp<i> Data e Hora que o você irá Ministrar a aula</i>
                    <br><br>
                    <label for='dt_repaula'>Data da Repo. da Aula: </label>
                    <input name="dt_repaula" id="dt_repaula" class="col-sm-0" onkeypress="mascaraData( this, event )" maxlength="10" value="<?php echo $dataR; ?>">
                    <label for=inicioR>Hora de Inicio: </label>
                    <input name="inicioR" id="inicioR" class="col-sm-0" type=time value="<?php echo $row0['sga_trocas_HrReposicao_I']; ?>">
                    <label for=fimR>Hora de Término: </label>
                    <input name="fimR" id="fimR" class="col-sm-0" type=time value="<?php echo $row0['sga_trocas_HrReposicao_T']; ?>">&nbsp &nbsp &nbsp<i> Data e Hora que o professor irá te substituir</i>
                    <br><br>
                    <label for="nomeProfessor"> Nome do Professor: </label>&nbsp
                    <input name="nomeProfessor" id="nomeProfessor" type="text" value="<?php echo $row0['sga_trocas_professor']; ?>">
                    <br><br>
                    <label for="just_troca">Justificativa da troca: </label>
                    <br>
                    <textarea name="just_troca" id="just_troca" cols=92 rows=3>
<?php echo $row0['sga_trocas_Justificativa']; ?>
</textarea>

                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Número do Diáro</label>
                  <div class="col-sm-10">
                    <select name="ndiario" id="ndiario" class="form-control col-sm-2" onchange="getValor(this.value, 0)" required>
                      <option value=""> </option>
                      <?php

                      // efetua a busca no banco de dados

                      $sql1 = "SELECT * FROM $banco.sga_diario where sga_diario_IDUser = $IDU ; ";
                      $stmt1 = $PDO->prepare($sql1);
                      $stmt1->execute();

                      while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {

                        echo "<option value='" . $row1['sga_diario_ID'] . "'>" . $row1['sga_diario_Numero'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                  <label class=" control-label" for="checkboxes">Ministrado aula em:</label>
                  <div class="col-sm-10">

                    <label for="qtd_aulas">

                      <label for="dt_aulas"></label>

                      <div class="form-group">
                        <input name="dt_aulas" id="dt_aulas" value="<?php echo $data; ?>" type="text" class="col-sm-2" onkeypress="mascaraData( this, event )" maxlength="10" required> das
                        <input name="inicio_aula" id="inicio_aula" value="<?php echo $row['horaI']; ?>" type="time" class="col-sm-2" required> ás
                        <input name="termino_aula" id="termino_aula" value="<?php echo $row['horaT']; ?>" type="time" class="col-sm-2" required> Total de Aulas:
                        <input name="qtd_aulas" id="qtd_aulas" value="<?php echo $row['qtdaulas']; ?>" type="number" max="10" class="col-sm-1" required>
                      </div>
                  </div>
                </div>

                <!-- Select -->
                <div class="form-group">
                  <label class="control-label" for="disciplina">Disciplina</label>
                  <div class="col-sm-10">


                    <select id="disciplina" name="disciplina" class="form-control" readonly required>

                    </select>
                  </div>
                </div>

                <!-- Lista de Turmas -->
                <div class="form-group">
                  <label class=" control-label" for="turma">Turma</label>
                  <div class="col-sm-10">
                    <select id="turma" name="turma" class="form-control" multiple="multiple" readonly>

                    </select>
                  </div>
                </div>




                <!-- campo de obs -->
                <div class="form-group">
                  <label class=" control-label" for="obs">Observações</label>
                  <div class="col-sm-10">
                    <input id="obs" name="obs" placeholder="OBS..." value="<?php echo $row['obs']; ?>" class="form-control input-md" type="search">
                  </div>
                </div>

                <!-- campo do conteúdo -->
                <div class="form-group">
                  <label class=" control-label" for="cont_min">Conteúdo Ministrado</label>
                  <div class="col-sm-10">
                    <textarea id="cont_min" name="cont_min" placeholder="Conteúdo Ministrado ....." cols=128 rows=3><?php echo $row['conteudo']; ?>
              </textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label" for="anexos">Anexos</label>
                </div>

                <!-- campo do anexos -->
                <div class="form-group">
                  <label class="control-label" for="planoAula">Plano De Aula</label>
                  <div class="col-sm-10">
                    <input type="text" id="planoAula" name="planoAula" class="form-control" value="<?php echo $row['planoAula']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label" for="atividade">Atividades</label>
                  <div class="col-sm-10">
                    <input type="text" id="atividade" name="atividade" class="form-control" value="<?php echo $row['atividades']; ?>">
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label" for="materialAula">Material da Aula</label>
                  <div class="col-sm-10">
                    <input type="text" id="materialAula" name="materialAula" class="form-control" value="<?php echo $row['material_aula']; ?>">
                  </div>
                </div>

              </fieldset>
              <div class="form-group">
                <div>
                  <button class="btn btn-success btn-flat m-b-10 m-l-5">Editar Aula</button>
                  <button class="btn btn-danger btn-flat m-b-10 m-l-5">Cancelar</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="footer">
        <p>SGCA <?php echo date('Y'); ?> - © - Todos Direitos Reservados - Desenvolvido By Laider Lucas </p>
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

  <!--  flot-chart js -->
  <script src="assets/js/lib/flot-chart/jquery.flot.js"></script>
  <script src="assets/js/lib/flot-chart/jquery.flot.resize.js"></script>
  <script src="assets/js/lib/flot-chart/flot-chart-init.js"></script>
  <!-- // flot-chart js -->

  <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
  <script src="assets/js/lib/weather/weather-init.js"></script>
  <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
  <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
  <script src="assets/js/scripts.js"></script>
  <!-- scripit init-->

</body>

</html>