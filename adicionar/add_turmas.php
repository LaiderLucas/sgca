  <body>
      <?php
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
                                          <input name="serie_ano" id="serie_ano" class="col-sm-1" type="number" min=1
                                              max=15 required placeholder="1"> &nbsp;&nbsp;&nbsp;
                                          <input type="radio" id="ano_semestre" name="ano_semestre" Value="Ano"> Ano
                                          &nbsp;&nbsp;&nbsp;
                                          <input type="radio" id="ano_semestre" name="ano_semestre" value="Semestre">
                                          Semestre
                                      </div>
                                  </div>

                                  <!-- Select -->
                                  <div class="form-group">
                                      <label class="control-label" for="disciplina">Truno</label>
                                      <div class="col-sm-10">
                                          <input type="radio" id="turno" name="turno" value="Matutino"> Matutino
                                          &nbsp;&nbsp;&nbsp;
                                          <input type="radio" id="turno" name="turno" Value="Vespertino"> Vespertino
                                          &nbsp;&nbsp;&nbsp;
                                          <input type="radio" id="turno" name="turno" Value="Noturno"> Noturno
                                          &nbsp;&nbsp;&nbsp;
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label" for="ano_inicio">Ano de Inicio</label>
                                      <div class="col-sm-10">
                                          <input class="col-sm-2" type="number" id="ano_inicio" name="ano_inicio"
                                              min=2019 required placeholder="2019">
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
                                          <input type="radio" id="instituicao" name="instituicao" value="1"
                                              checked="checked"> IFMT - CAMPUS PONTES E LACERDA/FRONTEIRA OESTE
                                          &nbsp;&nbsp;&nbsp;

                                      </div>
                                  </div>
                              </fieldset>
                              <div class="form-group">
                                  <div>
                                      <button class="btn btn-success btn-large m-b-10 m-l-5" type="submit">Cadastrar
                                          Turma</button>
                                      <button class="btn btn-danger btn-large m-b-10 m-l-5"
                                          onClick="JavaScript: window.history.back();">Voltar</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>

