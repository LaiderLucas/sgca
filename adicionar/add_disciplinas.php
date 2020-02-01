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
                            <h4>Cadastro de Disciplinas</h4>

                        </div>
                        <form name="cad_disciplina" action="inserir/inserir_disciplina.php" method="post">
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nome do Curso</label>
                                    <div class="col-sm-10">
                                        <input name="nomeDisciplina" id="nomeDisciplina" class="form-control"
                                            type="text" required placeholder="Disciplina">

                                    </div>
                                </div>

                                <!-- Select -->


                                <div class="form-group">
                                    <label class="control-label" for="nivel">Nivel da Disciplina (Superior /
                                        Médio)</label>
                                    <div class="col-sm-10">
                                        <input type="radio" id="nivel" name="nivel" value="Ensino Médio" required>
                                        Ensino Médio
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="nivel" name="nivel" value="Ensino Superior" required>
                                        Ensino Superior
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <div>
                                    <button class="btn btn-success btn-large m-b-10 m-l-5">Cadastrar Disciplina</button>
                                    <button class="btn btn-danger btn-large m-b-10 m-l-5"
                                        onClick="JavaScript: window.history.back();">Voltar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>