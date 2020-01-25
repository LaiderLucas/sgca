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
<style>

.col-sm-0{-ms-flex:0 0 10%;flex:0 0 10%;max-width:10%;

  min-height:1px;padding-right:15px;padding-left:15px
}


</style>        

        <script type="text/javascript">
        
      
        function ocultar(){
            document.getElementById("dvConteudo").style.display = "none";
        }
        
        function Exibir(){ // Quando clicar no botão.
        
                document.getElementById("dvConteudo").style.display = "block";//Exibimos a div..
               
        }
    </script>



    <script type="text/javascript">

    function mascaraData( campo, e )
{
	var kC = (document.all) ? event.keyCode : e.keyCode;
	var data = campo.value;
	
	if( kC!=8 && kC!=46 )
	{
		if( data.length==2 )
		{
			campo.value = data += '/';
		}
		else if( data.length==5 )
		{
			campo.value = data += '/';
		}
		else
			campo.value = data;
	}
}



		function getValor(valor){

			$("#disciplina").html("<option value='0'>Carregando...</option>");
			setTimeout(function(){
				$("#disciplina").load("core/carregaDisciplina.php",{id:valor})
			}, 250);
        $("#turma").html("<option value='0'>Carregando...</option>");
			setTimeout(function(){
				$("#turma").load("core/carregaTurma.php",{id:valor})
			}, 250);
    };
    


    </script>

    </head>

    <body>
<?php
require_once('core/config.php');
require_once('core/menu.php');
@$alert = $_SESSION['sucessoA'];
@$msg = $_SESSION['avisoA'];


?>
 <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Lançamento de Aulas</h4>
                                   
                                </div>
                                <form name="lancaAula" action="inserir/inserir_aula.php" method="post">
        <fieldset>
<div class="form-group">
<br>
<!-- Define sem imprime ou não o plano de aula -->
<label > Imprimir Plano de Aula? &nbsp &nbsp </label>
<input type="radio" value="1" name="imp_planoAula" id="imp_planoAula"  > Sim &nbsp &nbsp &nbsp
<input type="radio" value="0" name="imp_planoAula" id="imp_planoAula"  checked="checked" > Não &nbsp &nbsp &nbsp
<!-- Fim -->


<br><br>


<!-- Bloco de informação das aulas trocadas -->
<label class="control-label">Aula Trocada ? &nbsp &nbsp</label>
<input type="radio" value="1" name="t" id="t" onclick="Exibir();" > Sim &nbsp &nbsp &nbsp
<input type="radio" value="0" name="t" id="t" checked = "checked" onclick="ocultar();"> Não
<div id="dvConteudo" style='display:none;'>
<br>
<label for='dt_trocaaula'>Data da Troca da Aula: </label>
<input name="dt_trocauala" id="dt_trocaaula" class="col-sm-0" onkeypress="mascaraData( this, event )" maxlength ="10"  >
<label for=inicioT>Hora de Inicio: </label> 
<input name="inicioT" id="inicioT" class="col-sm-0" type=time>
<label for=fimT>Hora de Término: </label> 
<input name="fimT" id="fimT" class="col-sm-0" type=time> &nbsp &nbsp &nbsp<i> Data e Hora que o você irá Ministrar a aula</i>
<br><br>
<label for='dt_repaula'>Data da Repo. da Aula: </label>
<input name="dt_repaula" id="dt_repaula" class="col-sm-0" onkeypress="mascaraData( this, event )" maxlength ="10" >
<label for=inicioR>Hora de Inicio: </label> 
<input name="inicioR" id="inicioR" class="col-sm-0" type=time>
<label for=fimR>Hora de Término: </label> 
<input name="fimR" id="fimR" class="col-sm-0" type=time>&nbsp &nbsp &nbsp<i> Data e Hora que o professor irá te substituir</i>
<br><br>
<label for="nomeProfessor"> Nome do Professor: </label>&nbsp
<input name="nomeProfessor" id="nomeProfessor" type="text">
<br><br>
<label for="just_troca">Justificativa da troca: </label>
<br>
<textarea name="just_troca" id="just_troca" cols=92 rows=3 ></textarea>

 </div>
</div>
<!-- Fim-->

          
<div class="form-group">
<label class="col-sm-2 control-label">Número do Diáro</label>
<div class="col-sm-10">
       <select name="ndiario" id="ndiario" class="form-control col-sm-2" onchange="getValor(this.value, 0)">
       <option value = "0"> Selecione o Nº</option>
       <?php

// efetua a busca dos diários no banco de dados
$PDO = db_connect();
$IDU = base64_decode($_COOKIE['SID']);
$sql = "SELECT * FROM $banco.sga_diario where sga_diario_IDUser = $IDU ; ";
$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

echo"<option value='".$row['sga_diario_ID']."'>".$row['sga_diario_Numero']."</option>";

}
?>
    </select>
                     

                                                   <!-- <input id='ndiario' name='ndiario' type="number" riquired class="form-control"> -->
                                                </div>
                                            </div>
          
<!-- Data, hora e quantidade de aulas -->
          <div class="form-group">
            <label class=" control-label" for="checkboxes">Ministrado aula em:</label>
            <div class="col-sm-10">
              
                <label for="qtd_aulas">
                  
                <label for="dt_aulas"></label>
                
                <div class="form-group">
                <input name="dt_aulas" id="dt_aulas" value="" type="text" class="col-sm-2" maxlength = "10" required onkeypress="mascaraData( this, event )" > das            
                <input name="inicio_aula" id="inicio_aula" value="" type="time" class="col-sm-2"  required  > ás 
                  <input name="termino_aula" id="termino_aula" value="" type="time" class="col-sm-2" required> Total de Aulas: 
                  <input name="qtd_aulas" id="qtd_aulas" value="" type="number" max="10" class="col-sm-1" required>
                </div>   
            </div>
          </div>
<!-- Fim -->
  
  <!-- Listas Disciplinas -->
          <div class="form-group">
            <label class="control-label" for="disciplina">Disciplina</label>
            <div class="col-sm-10">
              <select id="disciplina" name="disciplina" class="form-control" readonly required>                    
              </select>
            </div> 
          </div>
<!-- Fim -->

          <!-- Lista de Turmas -->
          <div class="form-group">
            <label class=" control-label" for="turma">Turma</label>
            <div class="col-sm-10">
              <select id="turma" name="turma" class="form-control" multiple="multiple" readonly>
              </select>
            </div>
          </div> 
          <!-- Fim -->

          

          <!-- campo de obs -->
          <div class="form-group">
            <label class=" control-label" for="obs">Observações</label>
            <div class="col-sm-10">
              <input id="obs" name="obs" placeholder="OBS..." class="form-control input-md" type="search">
            </div>
          </div>
          <!-- Fim -->

          <!-- campo do conteúdo -->
          <div class="form-group">
            <label class=" control-label" for="cont_min">Conteúdo Ministrado</label>
            <div class="col-sm-10">                  
              <textarea id="cont_min" name="cont_min" placeholder="Conteúdo Ministrado ....." cols=128 rows=3 ></textarea>
            </div>
          </div>
           <!-- Fim -->

          <div class="form-group">
          <label class="control-label" for="anexos">Anexos</label>
          </div>

          <!-- campo do anexos -->
          <div class="form-group">
            <label class="control-label" for="planoAula">Plano De Aula</label>
            <div class="col-sm-10">                  
              <input type="text" id="planoAula" name="planoAula" class="form-control" >
            </div>
          </div>
          <!-- Fim -->

          <!-- Atividades -->
          <div class="form-group">
            <label class="control-label" for="atividade">Atividades</label>
            <div class="col-sm-10">                  
              <input type="text" id="atividade" name="atividade" class="form-control" >
            </div>
          </div>
          <!-- Fim -->

          <!-- Material das aulas -->
          <div class="form-group">
            <label class="control-label" for="materialAula">Material da Aula</label>
            <div class="col-sm-10">                  
              <input type="text" id="materialAula" name="materialAula" class="form-control" >
            </div>
          </div>
          <!-- Fim -->

        </fieldset>
        <!-- Botões -->
         <div class="form-group">
            <div>
              <button class="btn btn-success btn-flat m-b-10 m-l-5">Lançar Aula</button>
               <button  class="btn btn-danger btn-flat m-b-10 m-l-5">Cancelar</button>
            </div>
          </div>
        <!-- Fim -->
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
