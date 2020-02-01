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
                            <h4>Cadastro de Cursos</h4>

                        </div>
                        <form name="cad_curso" action="inserir/inserir_curso.php" method="post">
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nome do Curso</label>
                                    <div class="col-sm-10">
                                        <input name="nomeCurso" id="nomeCurso" class="form-control" type="text" required
                                            placeholder="Curso xxx">

                                    </div>
                                </div>

                                <!-- Select -->


                                <div class="form-group">
                                    <label class="control-label" for="duracao">Tempo de Duração (Semestres)</label>
                                    <div class="col-sm-10">
                                        <input class="col-sm-1" type="number" id="duracao" name="duracao" required
                                            placeholder="1"> &nbsp;&nbsp;&nbsp; Semestre(s)
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
                                    <button class="btn btn-success btn-large m-b-10 m-l-5">Cadastrar Curso</button>
                                    <button class="btn btn-danger btn-large m-b-10 m-l-5"
                                        onClick="JavaScript: window.history.back();">Voltar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>