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
                            <h4>Cadastro de Diários</h4>

                        </div>
                        <form name="cad_diario" action="inserir/inserir_diario.php" method="post">
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Número do Diáro</label>
                                    <div class="col-sm-10">
                                        <input name="ndiario" id="ndiario" class="form-control col-sm-2" type="number"
                                            required>
                                    </div>
                                </div>

                                <!-- Select -->
                                <div class="form-group">
                                    <label class="control-label" for="disciplina">Disciplina</label>
                                    <div class="col-sm-10">


                                        <select id="disciplina" name="disciplina" class="form-control" required>
                                            <?php

                      $PDO = db_connect();
                      $IDU = base64_decode($_COOKIE['SID']);
                      $sql = "SELECT  * FROM $tabela_disciplina where sga_disciplina_IDUser = $IDU ;";
                      $stmt = $PDO->prepare($sql);
                      $stmt->execute();

                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["sga_disciplina_ID"] . "'>" . htmlentities($row["sga_disciplina_Nome"]) . "</option>\n";
                      }

                      ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Lista de Turmas -->
                                <div class="form-group">
                                    <label class=" control-label" for="turma">Turma</label>
                                    <div class="col-sm-10">
                                        <select id="turma" name="turma" class="form-control">
                                            <?php
                      $IDU = base64_decode($_COOKIE['SID']);
                      $PDO = db_connect();
                      $sql = "SELECT $tabela_turma.sga_turma_ID AS turma_ID , $tabela_turma.sga_turma_SerieAno AS SerieAno , $tabela_turma.sga_turma_ano_semestre AS semestre,
$tabela_curso.sga_curso_Nome AS curso_Nome, $tabela_turma.sga_turma_Turno AS turno FROM sga_turma 
inner join $tabela_curso on $tabela_turma.sga_turma_Curso = $tabela_curso.sga_curso_ID where $tabela_turma.sga_turma_IDUser = $IDU
;";
                      $stmt = $PDO->prepare($sql);
                      $stmt->execute();

                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["turma_ID"] . "'>" . htmlentities($row["SerieAno"]) . "º - " . $row['semestre'] . " - " . $row['curso_Nome'] . " - " . $row['turno'] . "</option>\n";
                      }

                      ?>
                                        </select>
                                    </div>
                                </div>






                            </fieldset>
                            <div class="form-group">
                                <div>
                                    <button class="btn btn-success btn-large m-b-10 m-l-5">Cadastrar Diário</button>
                                    <button class="btn btn-danger btn-large m-b-10 m-l-5"
                                        onClick="JavaScript: window.history.back();">Voltar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>