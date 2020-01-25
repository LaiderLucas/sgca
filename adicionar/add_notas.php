<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SGCA - SISTEMA DE GESTÃO E CONTROLE DE AULAS</title>


    <!-- Styles -->
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="assets/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
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
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Lançamento de Notas </h4>
                            </div>
                            <form action="" method="POST">
                                <label class="label-control">Nº Do Diário:&nbsp </label>
                                <select name="ndiario" id="ndiario" class="col-sm-2" onchange="getValor(this.value, 0)">
                                    <option value="0"> Selecione o Nº</option>
                                    <?php

// efetua a busca dos diários no banco de dados
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $ndiario = $_POST['ndiario'];
}else{
    $ndiario = 0;
}
$PDO = db_connect();
$IDU = base64_decode($_COOKIE['SID']);
$sql = "SELECT * FROM $banco.sga_diario where sga_diario_IDUser = $IDU order by sga_diario_ID; ";
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

echo"<option value='".$row['sga_diario_ID']."'";
if ($ndiario == $row['sga_diario_ID']) {
echo "Selected = 'true'";
}
echo "> ".$row['sga_diario_Numero']."</option>";

}
?>
                                </select> &nbsp &nbsp &nbsp

                                <input class="btn btn-large btn-success" type="submit" value="Atualizar" />
                            </form>
                            <br>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form action="inserir/inserir_notas.php" id="cad_notas" name="cad_notas" method="POST">
                                        <label for="descricao">Descrição: &nbsp </label><input id="descricao"
                                            name="descricao" type="text" class=""> &nbsp &nbsp
                                        <label for="peso">Com o Peso: &nbsp </label><input id="peso" name="peso"
                                            class="">&nbsp &nbsp
                                        <label for="periodo"> Do Bim/Sem: &nbsp </label><select id="periodo"
                                            name="periodo" class="">
                                            <option value="">Selecione</option>
                                            <option value="1">1º Bimestre</option>
                                            <option value="2">2º Bimestre</option>
                                            <option value="3">3º Bimestre</option>
                                            <option value="4">4º Bimestre</option>
                                        </select>&nbsp &nbsp
                                        <label for="tipo">Do Tipo: &nbsp </label><select id="tipo" name="tipo" class="">
                                            <option value="">Selecione</option>
                                            <option value="1">Prova</option>
                                            <option value="2">Trabalho</option>
                                            <option value="3">Atividade Avaliativa</option>
                                        </select>&nbsp &nbsp
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Matricula</th>
                                                    <th>Nome</th>
                                                    <th>Turma</th>
                                                    <th>Nota</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $ndiario = $_POST['ndiario'];
    echo '<input style = "display:none;" id="ndiario" name="ndiario" value="'.$ndiario.'">';
    $sql = "SELECT sga_matricula.sga_matricula_ID AS id, sga_aluno.sga_aluno_Matricula AS matricula, sga_aluno.sga_aluno_Nome AS nome, 
    sga_turma.sga_turma_SerieAno AS SerieAno , sga_turma.sga_turma_ano_semestre AS semestre,
    sga_curso.sga_curso_Nome AS curso_Nome, sga_turma.sga_turma_Turno AS turno
    FROM sga_matricula
    inner join sga_diario on sga_diario.sga_diario_ID = sga_matricula.sga_matricula_Diario
    INNER JOIN sga_aluno ON sga_matricula.sga_matricula_Aluno = sga_aluno.sga_Aluno_ID
    inner join sga_turma on sga_turma.sga_turma_ID = sga_diario.sga_diario_Turma
    inner join sga_curso on sga_turma.sga_turma_Curso = sga_curso.sga_curso_ID
    WHERE sga_matricula_Diario = $ndiario;";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <tr>
        <td><input id="matricula[]" name="matricula[]" style="background-color:#0000; Border:0;" value="'.$row['matricula'].'" readonly></td>
        <td>'.$row['nome'].'</td>
        <td>'.$row["SerieAno"] . "º - " . $row['semestre'] . " - " . $row['curso_Nome'] . " - " . $row['turno'] .'</td>
        <td><input style="Border:0;" class="form-control" type="number" name="nota[]" id="nota[]" value="0.00" min="0"  max="10" required></td>
     </tr>';
    }
}
?>
                                            </tbody>
                                        </table>
                                        <br>
                                        <button type="submit" class="btn btn-success">Lanças Notas</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        </section>

        <div id="search">
            <button type="button" class="close">×</button>
            <form>
                <input type="search" value="" placeholder="type keyword(s) here" />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <!-- bootstrap -->
    <script src="assets/js/scripts.js"></script>
    <!-- scripit init-->
</body>

</html>