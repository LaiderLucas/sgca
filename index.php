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
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="Scripts/scriptFiltraAula.js"></script>


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
    </script>

</head>


<body>
    <?php

    require_once('core/menu.php');

    ?>


    <!-- /# sidebar -->


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h6>Eai, <?php echo $_COOKIE['Nome']; ?> , Tudo Joia?</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Tarefas ** Em Desenvolvimento **</h4>
                            </div>
                            <div class="todo-list">
                                <div class="tdl-holder">
                                    <div class="tdl-content">
                                        <ul>
                                            <li>
                                                <label>
                                                    <input type="checkbox"><i></i><span>Provas das turmas do 3º
                                                        ano</span>
                                                    <a href='#' class="ti-close"></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" checked><i></i><span>Lançamento das notas do
                                                        3º Bimestre no Q-Acadêmico</span>
                                                    <a href='#' class="ti-close"></a>
                                                </label>
                                            </li>

                                        </ul>
                                    </div>
                                    <input type="text" class="tdl-new form-control"
                                        placeholder="Escreva a nova tarefa aqui e pressione 'Enter'">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4> Ta aqui sua lista de trocas e reposições de aulas!</h4>
                            </div>
                            <div class="recent-comment">

                                <?php

                                $IDU = base64_decode($_COOKIE['SID']);
                                $PDO = db_connect();
                                $query0 = "SELECT $tabela_trocas.sga_trocas_IDTroca as ID, $tabela_turma.sga_turma_SerieAno AS ano, $tabela_turma.sga_turma_ano_semestre AS ano_semestre, $tabela_curso.sga_curso_Nome AS nomeCurso, 
                                            $tabela_turma.sga_turma_Turno AS Turno,   
                                            $tabela_trocas.sga_trocas_DtReposicao as DtReposicao, $tabela_trocas.sga_trocas_HrReposicao_I as HrReposicao_I,
                                            $tabela_trocas.sga_trocas_DtTroca as DtTroca, $tabela_trocas.sga_trocas_HrTroca_I as HrTroca_I,$tabela_trocas.sga_trocas_HrTroca_T as HrTroca_T,
                                            $tabela_trocas.sga_trocas_professor as professor,
                                             $tabela_trocas.sga_trocas_HrReposicao_T as HrReposicao_T, $tabela_trocas.sga_trocas_Justificativa as Justificativa, 
                                            $tabela_trocas.sga_trocas_professor as professor
                                            FROM $tabela_trocas 
                                            inner join $tabela_aulas on $tabela_aulas.sga_aulas_IDTroca = $tabela_trocas.sga_trocas_IDTroca 
                                            INNER JOIN $tabela_diario ON $tabela_diario.sga_diario_ID = $tabela_aulas.sga_aulas_NDiario 
                                            INNER JOIN $tabela_turma ON sga_turma_ID = sga_diario.sga_diario_Turma
                                            INNER JOIN $tabela_curso ON $tabela_curso.sga_curso_ID = $tabela_turma.sga_turma_Curso
                                            where $tabela_trocas.sga_trocas_DtReposicao >= CURRENT_DATE() and $tabela_aulas.sga_aulas_IDUser = $IDU order by DtReposicao limit 5;";
                                $stmt0 = $PDO->prepare($query0);
                                $stmt0->execute();
                                $controle = 0;



                                while ($row0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
                                    $controle++;

                                    $dtr = implode('/', array_reverse(explode('-', $row0['DtReposicao'])));
                                    $dtt = implode('/', array_reverse(explode('-', $row0['DtTroca'])));
                                    if ($dtt == date('d/m/Y')) {
                                        $repHoje = "Reposição Hoje";
                                        $btn_cor = "danger";
                                    } else {
                                        $repHoje = "Confirmada";
                                        $btn_cor = "success";
                                    };


                                    echo '
                                            <div class="media">
                                            <div class="media-body">
                                                <h4 class="media-heading"> ' . $row0['ano'] . ' º ' . $row0['ano_semestre'] . ' - ' . $row0['nomeCurso'] . ' - ' . $row0['Turno'] . '</h4>
                                                <p><b>Início às:  ' . $row0['HrTroca_I'] . ' - Término às: ' . $row0['HrTroca_T'] . ' </b></p>
                                                @ Prof@ <b>' . $row0['professor'] . '</b> Irá Te Substituir Dia: <p><b>' . $dtr . ' - Das ' . $row0['HrReposicao_I'] . ' às ' . $row0['HrReposicao_T'] . '</b></p>
                                               
                                            <div class="comment-action">
                                                    <div class="badge badge-' . $btn_cor . '">' . $repHoje . '</div>
                                            </div>
                                                <p class="comment-date">' . $dtt . '</p>
                                         </div>
                                        </div>
                                            ';
                                }

                                if ($controle == 0) {
                                    echo '   <div class="media">
                                                   <div class="media-body">
                                                       <h4 class="media-heading"> Opa! <br> Sem nenhuma troca encontrada, que massa!! </h4>
                                                       </div>
                                        </div>';
                                }

                                ?>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>

                    <div class="row">

                        <!-- Tabela -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Suas Aulas : </h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="aulas" class="table">
                                            <thead>
                                                <tr>
                                                    <p>Legenda:</p>
                                                    <span class='btn btn-success btn-rounded btn-sm'>N</span>&nbsp Aula
                                                    Normal
                                                    &nbsp &nbsp / &nbsp &nbsp
                                                    <span class='btn btn-warning btn-rounded btn-sm'>T</span>&nbsp Aula
                                                    Trocada
                                                </tr>
                                                <tr>
                                                    <th>Bimestre/Semestre</th>
                                                    <th>Nº Diario</th>
                                                    <th>Turma</th>
                                                    <th>Disciplina</th>
                                                    <th>Data</th>
                                                    <th>Horario</th>
                                                    <th>Nº Aulas</th>
                                                    <th>Status/Ação</th>

                                                </tr>
                                                <tr>
                                                    <th><input type="text" class="form-control input-sm" id="numero">
                                                    </th>
                                                    <th><input type="number" class="form-control input-sm" id="ndiario">
                                                    </th>
                                                    <th><input type="text" class="form-control input-sm" id="turma">
                                                    </th>
                                                    <th><input type="text" class="form-control input-sm"
                                                            id="disciplina"></th>
                                                    <th><input type="text" class="form-control input-sm" id="data"
                                                            onkeypress="mascaraData( this, event )" maxlength="10">
                                                    </th>
                                                    <th><input type="time" class="form-control input-sm" id="hora"></th>
                                                    <th><input type="number" class="form-control input-sm" id="naulas">
                                                    </th>
                                                    <th><input type="text" class="form-control input-sm" id="numero"
                                                            disabled></th>

                                                </tr>


                                            </thead>
                                            <?php



                                            $ID = 0;
                                            $PDO = db_connect();
                                            $IDU = base64_decode($_COOKIE['SID']);


                                            // consulta as aulas
$sql = "SELECT $tabela_aulas.sga_aulas_ID AS IDaula, $tabela_aulas.sga_aulas_qtdAulas AS qtdaulas, 
$tabela_aulas.sga_aulas_Data AS dataAula, $tabela_aulas.sga_aulas_HoraI AS horaI, $tabela_aulas.sga_aulas_HoraT AS horaT, 
$tabela_aulas.sga_aulas_Obs AS obs, $tabela_aulas.sga_aulas_Conteudo AS conteudo, $tabela_aulas.sga_aulas_IDTroca AS Troca,
$tabela_diario.sga_diario_Disciplina AS disciplina, $tabela_diario.sga_diario_Turma AS turma, $tabela_diario.sga_diario_Numero AS diario,
$tabela_turma.sga_turma_Turno AS Turno, $tabela_turma.sga_turma_SerieAno AS ano,$tabela_turma.sga_turma_ano_semestre AS ano_semestre, $tabela_turma.sga_turma_AnoInicio AS anoInicio,
$tabela_curso.sga_curso_Nome AS nomeCurso,
$tabela_diario.sga_diario_ID AS IDDiario,
$tabela_disciplina.sga_disciplina_Nome AS nomeDisciplina
FROM $tabela_aulas
INNER JOIN $tabela_diario ON $tabela_diario.sga_diario_ID = $tabela_aulas.sga_aulas_NDiario
INNER JOIN $tabela_turma ON sga_turma_ID = $tabela_diario.sga_diario_Turma
INNER JOIN $tabela_curso ON $tabela_curso.sga_curso_ID = $tabela_turma.sga_turma_Curso
INNER JOIN $tabela_disciplina ON $tabela_disciplina.sga_disciplina_ID = $tabela_diario.sga_diario_Disciplina
where sga_aulas_IDUser = $IDU and sga_aulas_Data >= '2018-31-12'
ORDER BY dataAula DESC"; //LIMIT $inicio,$total_reg" ;
                                            $stmt = $PDO->prepare($sql);
                                            $stmt->execute();

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $IDDiario = $row['IDDiario'];
                                                $dt_aula  = $row['dataAula'];
                                                $bimSem = $row['ano_semestre'];
                                                if ($bimSem == "Ano") {
                                                    $bimSem = "Bimestre";
                                                }
                                                // faz a consulta no banco de dados do periodo do bimestre ou semestre das aulas
                                                $sql1 = "SELECT sga_bim_sem.sga_bim_sem_NbimSem as Numero, sga_bim_sem.sga_bim_sem_BimOrSem as bimOrSem, sga_diario_periodo.sga_Diario_Periodo_NDiario as NDiario
                                                FROM $banco.sga_bim_sem
                                                inner join sga_diario_periodo on sga_bim_sem.sga_bim_sem_ID = sga_diario_periodo.sga_Diario_Periodo_IDBim_sem where sga_bim_sem_Inicio <= '$dt_aula' and sga_bim_sem_termino >= '$dt_aula' and sga_bim_sem_BimOrSem = '$bimSem' and sga_Diario_Periodo_NDiario = $IDDiario ;";
                                                $stmt5 = $PDO->prepare($sql1);
                                                $stmt5->execute();
                                                $row2 = $stmt5->fetch(PDO::FETCH_ASSOC);
                                                if($bimSem == "Semestre"){
                                                    $N = $row['ano'];
                                                }else{   
                                                    $N = $row2['Numero'];
                                                    }
                                                $BoS = $row2['bimOrSem'];

                                                $data = date('d/m/Y', strtotime($row['dataAula'])); // converte a data para o formato brasileiro DD/MM/AAAA

                                                $ID++;

                                                if (($row['Troca'] == null) or ($row['Troca'] == "")) {

                                                    $btn = "success";
                                                    $tipo = "N";
                                                } else {
                                                    $btn = "warning";
                                                    $tipo = "T";
                                                }
                                                echo "  <tbody>
                                                    <tr>
                                                        <td>" . $N . "º - " . $BoS . "</td>
                                                        <td>" . $row['diario'] . "</td>
                                                        <td>" . $row['ano'] . "º - " . $row['ano_semestre'] . " - " . $row['nomeCurso'] . " - " . $row['Turno'] . "</td>
                                                        <td>" . $row['nomeDisciplina'] . "</td>
                                                        <td>" . $data . "</td>
                                                        <td>" . $row['horaI'] . " às " . $row['horaT'] . "</td>
                                                        <td>" . $row['qtdaulas'] . "</td>
                                                        <form action='editar/editar_aula.php' method='POST'>
                                                        <td>
                                                        
                                                        <span class='btn btn-" . $btn . " btn-rounded'>" . $tipo . "</span>
                                                        
                                                        <button type='subumit' data-toggle='modal' class='btn btn-info btn-outline btn-rounded id='editaraula-" . $row['IDaula'] . "'>
                                                        
                                                        
                                                        <input type='hidden' id='IDAula' name='IDAula'  value='" . $row['IDaula'] . "'>
                                                        <i  class='ti ti-pencil'></i></button>
                                                       

                                                        <a href='#' data-toggle='modal' data-target='#add-category-" . $row['IDaula'] . "' class='btn btn-info btn-outline btn-rounded' id='maisinfo-" . $row['IDaula'] . "'>
                                                        <i class = 'ti ti-plus'></i> Info. </a>

                                                        </td>
                                                        </form>
                                                    </tr>";
                                            }


                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                                /* continuação da paginação
  $IDU = base64_decode($_COOKIE['SID']);
 $anterior = $pc -1;
 $proximo = $pc +1;
 if ($pc>1) {
 echo " <a href='?pagina=$anterior' class='ti-angle-double-left'> ANTERIOR</a> ";
}
 
 if ($pc<$tp) {
 echo " <a href='?pagina=$proximo' class='ti-angle-double-right'> PROXIMA</a>";
 }
 */
                                ?>

                            </div>

                        </div>
                    </div>


                    <?php
                    // faz a busca dos demais dados do registro para gravar no modal
                    $ID = 0;
                    $PDO = db_connect();

                    $sql = "SELECT $tabela_aulas.sga_aulas_ID AS IDaula, $tabela_aulas.sga_aulas_Data AS dataAula, $tabela_aulas.sga_aulas_IDTroca AS troca, $tabela_aulas.sga_aulas_dtLanacamento AS dtlancamento, $tabela_aulas.sga_aulas_dtEdicao AS dt_edicao,
                                                $tabela_aulas.sga_aulas_Obs AS obs, $tabela_aulas.sga_aulas_Conteudo AS conteudo, $tabela_aulas.sga_aulas_planoAula AS planoAula,
                                                $tabela_aulas.sga_aulas_material_aula AS material_aula, $tabela_aulas.sga_aulas_atividade AS atividades
                                                FROM $tabela_aulas
                                                INNER JOIN $tabela_diario ON $tabela_diario.sga_diario_ID = $tabela_aulas.sga_aulas_NDiario
                                                INNER JOIN $tabela_turma ON sga_turma_ID = $tabela_diario.sga_diario_Turma
                                                INNER JOIN $tabela_curso ON $tabela_curso.sga_curso_ID = $tabela_turma.sga_turma_Curso
                                                INNER JOIN $tabela_disciplina ON $tabela_disciplina.sga_disciplina_ID = $tabela_diario.sga_diario_Disciplina
                                                where $tabela_aulas.sga_aulas_IDUser = $IDU";
                    $stmt = $PDO->prepare($sql);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $data = date('d/m/Y', strtotime($row['dataAula'])); // converte a data para o formato brasileiro DD/MM/AAAA

                        $datalanc = date('d/m/Y', strtotime($row['dtlancamento']));

                        $ID++;

                        if ($row['planoAula'] == '') {
                            $semlinkp = "Sem Link do Plano de Aulas";
                        } else {
                            $semlinkp = "Click Para Visualizar";
                        }
                        if ($row['material_aula'] == '') {
                            $semlinkm = "Sem Link do Material da Aula";
                        } else {
                            $semlinkm = "Click Para Visualizar";
                        }
                        if ($row['atividades'] == '') {
                            $semlinka = "Sem Link da Atividade";
                        } else {
                            $semlinka = "Click Para Visualizar";
                        }
                        echo "
<div class='modal fade none-border' id='add-category-" . $row['IDaula'] . "'>
    <div class='modal-dialog'>
        <div class='modal-content'>
                        <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                              <h4 class='modal-title'><strong>Informações Adicionais - " . $row['IDaula'] . " </strong></h4>
                        </div>
            <div class='modal-body'>
                            
                        <div class='row'>
                        
                      

                            <div class='col-md-6'>
                                  <h5>Data de Lançamento: </h5>
                                    <label class='control-label'>" . $datalanc . "</label>

                            </div>
                        
                        <div class='col-md-6'>
                                  <h5>Conteúdo: </h5>
                                    <label class='control-label'>" . $row['conteudo'] . "</label>
                                    
                         </div>
                            <div class='col-md-6'>
                                  <h5>Observações: </h5>
                                    <label class='control-label'>" . $row['obs'] . "</label>

                            </div>

                            <div class='col-md-6'>
                                  <h5>Plano de Aula: </h5>
                                    
                                  <label class='control-label'><a href='" . $row['planoAula'] . "'> " . $semlinkp . " </a></label>

                            </div>

                            <div class='col-md-6'>
                                  <h5>Material Da Aula: </h5>
                                    <label class='control-label'><a href='" . $row['material_aula'] . "'> " . $semlinkm . " </a></label>

                            </div>

                            <div class='col-md-6'>
                                  <h5>Atividades: </h5>
                                    <label class='control-label'><a href='" . $row['atividades'] . "'> " . $semlinka . " </a></label>

                            </div>
                            ";
                        if ($row['troca'] > 0) {
                            $t = $row['troca'];
                            $query1 = "SELECT sga_trocas_DtReposicao, sga_trocas_HrReposicao_I, sga_trocas_HrReposicao_T, sga_trocas_professor FROM $banco.sga_trocas where sga_trocas_IDTroca = $t;";
                            $stmt1 = $PDO->prepare($query1);
                            $stmt1->execute();
                            $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                            $dtr = implode('/', array_reverse(explode('-', $row1['sga_trocas_DtReposicao'])));


                            echo "  <div class='col-md-6'>
                                  <h5>Dados da Troca: </h5>
                                    <label class='control-label'>Aula Trocada com <b>" . $row1['sga_trocas_professor'] . "</b> - Hora e Data que o Prof@ irá repor as aulas <b>" . $dtr . "</b> - das <b> " . $row1['sga_trocas_HrReposicao_I'] . "</b> às <b>" . $row1['sga_trocas_HrReposicao_T'] . "</b></label>

                            </div>";
                        } else {
                            echo "  <div class='col-md-6'>
    <h5>Dados da Troca: </h5>
      <label class='control-label'>Sem Dados de Trocas!</label>

</div>";
                        }



                        echo "
                            </div>

                             
            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Close</button>
                              
                            </div>
        </div>
    </div>
</div>";
                    }


                    include('core/footer.php');
                    ?>



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