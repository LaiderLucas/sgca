<?php
include('../core/config.php');
include("../core/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 
// inicia a session
session_start();
//seta a timezone para pegar data e hora
date_default_timezone_set('America/Cuiaba');
$dt_lanc = date('Y-m-d');
$ndiario = $_POST['ndiario'];
$dt_aulas = $_POST['dt_aulas'];
$inicio_aula = $_POST['inicio_aula'];
$termino_aula = $_POST['termino_aula'];
$qtd_aulas = $_POST['qtd_aulas'];
$obs = $_POST['obs'];
$cont_min = $_POST['cont_min'];
$planoAula = $_POST['planoAula'];
@$atividades = $_POST['atividades'];
$materialAula = $_POST['materialAula'];
$t = $_POST['t'];
$imp_planoAula = $_POST['imp_planoAula'];


$dtaulas = implode('-', array_reverse(explode('/', $dt_aulas)));

$PDO = db_connect();


$sql="INSERT INTO `$banco`.`$tabela_aulas` ( `sga_aulas_NDiario`, `sga_aulas_qtdAulas`, `sga_aulas_Data`, `sga_aulas_HoraI`, `sga_aulas_HoraT`, `sga_aulas_Obs`, `sga_aulas_Conteudo`,`sga_aulas_planoAula`,`sga_aulas_material_aula`,`sga_aulas_atividade`, `sga_aulas_dtLanacamento`, `sga_aulas_IDUser`) VALUES 
(:ndiario, :qtd_aulas, :dt_aulas, :inicio_aula, :termino_aula, :obs, :cont_min, :planoAula, :materialAula, :atividades, :dt_lanc, :IDUser);";

$stmt = $PDO->prepare($sql);
$stmt->BindParam(':ndiario',$ndiario);
$stmt->BindParam(':qtd_aulas', $qtd_aulas);
$stmt->BindParam(':dt_aulas', $dtaulas);
$stmt->BindParam(':inicio_aula', $inicio_aula);
$stmt->BindParam(':termino_aula', $termino_aula);
$stmt->BindParam(':obs', $obs);
$stmt->BindParam(':cont_min', $cont_min);
$stmt->BindParam(':planoAula', $planoAula);
$stmt->BindParam('materialAula', $materialAula);
$stmt->BindParam(':atividades', $atividades);
$stmt->BindParam(':dt_lanc', $dt_lanc);
$stmt->BindParam(':IDUser', base64_decode($_COOKIE['SID']));

if ($stmt->execute()){
	$_SESSION['sucesso'] = 1;
}else {
	$_SESSION['sucesso'] = 0;
	$_SESSION['aviso'] = "ERRO AO LANÇAR AULA!";
	print_r($stmt);	
die;
}

if ($t == 1){
	$dt_trocauala=$_POST['dt_trocauala'];
	$inicioT=$_POST['inicioT'];
	$fimT=$_POST['fimT'];
	$dt_repaula=$_POST['dt_repaula'];
	$inicioR=$_POST['inicioR'];
    $fimR=$_POST['fimR'];
    $nomeProfessor=$_POST['nomeProfessor'];
	$just_troca=$_POST['just_troca'];
	$dttrocauala = implode('-', array_reverse(explode('/', $dt_trocauala)));
	$dtrepaula = implode('-', array_reverse(explode('/', $dt_repaula)));
    @$obsTroca = "Aula Trocada Com ".$nomeProfessor;
	
	
	$query = "SELECT sga_aulas_ID FROM $banco.$tabela_aulas order by sga_aulas_ID desc limit 1; ";
	$stmt = $PDO->prepare($query);
$stmt->execute();
$IDA = $stmt->fetch(PDO::FETCH_ASSOC);

	$sql1="INSERT INTO $banco.$tabela_trocas (`sga_trocas_IDAula`, `sga_trocas_DtTroca`, `sga_trocas_HrTroca_I`, `sga_trocas_HrTroca_T`, `sga_trocas_DtReposicao`, `sga_trocas_HrReposicao_I`, `sga_trocas_HrReposicao_T`, `sga_trocas_Justificativa`,`sga_trocas_professor`) VALUES 
										  (:IDA, :dt_trocauala, :inicioT, :fimT, :dt_repaula, :inicioR, :fimR, :just_troca, :nomeProfessor);";
	
	$stmt = $PDO->prepare($sql1);
	$stmt->BindParam(':IDA',$IDA['sga_aulas_ID']);
	$stmt->BindParam(':dt_trocauala', $dttrocauala);
	$stmt->BindParam(':inicioT',$inicioT);
	$stmt->BindParam(':fimT', $fimT);
	$stmt->BindParam(':dt_repaula', $dtrepaula);
	$stmt->BindParam(':inicioR', $inicioR);
	$stmt->BindParam(':fimR', $fimR);
    $stmt->BindParam(':just_troca', $just_troca);
    $stmt->BindParam(':nomeProfessor',$nomeProfessor);
	
	if ($stmt->execute()){
		$_SESSION['sucessoA'] = 1;
	}else {
		$_SESSION['sucessoA'] = 0;
		$_SESSION['avisoA'] = "ERRO AO LANÇAR AULA!";
		print_r($stmt);	
	die;
	}

$query1 = "SELECT sga_trocas_IDTroca FROM $banco.$tabela_trocas order by sga_trocas_IDTroca desc limit 1; ";
$stmt = $PDO->prepare($query1);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$idt = $row['sga_trocas_IDTroca'];

$sql2 = "UPDATE `$banco`.`$tabela_aulas` SET `sga_aulas_IDTroca`=:idt WHERE `sga_aulas_ID`=:IDA;";
$stmt= $PDO->prepare($sql2);
$stmt->BindParam(':IDA',$IDA['sga_aulas_ID']);
$stmt->BindParam(':idt', $idt);
$stmt->execute();

if ($stmt->execute()){
	$_SESSION['sucessoT'] = 1;
}else {
	$_SESSION['sucessoT'] = 0;
	$_SESSION['avisoT'] = "ERRO AO LANÇAR TROCA!";
	print_r($stmt);	
die;
}

}
if ($imp_planoAula == 1){
$query2 = "SELECT  $tabela_turma.sga_turma_SerieAno AS ano,$tabela_turma.sga_turma_ano_semestre AS ano_semestre,
$tabela_curso.sga_curso_Nome AS nomeCurso, sga_turma_Turno AS turno,
$tabela_disciplina.sga_disciplina_Nome AS nomeDisciplina,
$tabela_diario.sga_diario_Numero as numeroDiario
FROM $tabela_aulas
INNER JOIN $tabela_diario ON $tabela_diario.sga_diario_ID = $ndiario
INNER JOIN $tabela_turma ON sga_turma_ID = $tabela_diario.sga_diario_Turma
INNER JOIN $tabela_curso ON $tabela_curso.sga_curso_ID = $tabela_turma.sga_turma_Curso
INNER JOIN $tabela_disciplina ON $tabela_disciplina.sga_disciplina_ID = $tabela_diario.sga_diario_Disciplina
limit 1;
";
$stmt = $PDO->prepare($query2);
$stmt->execute();
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);

$ano = $row2['ano'];
$ano_semestre = $row2['ano_semestre'];
$nomeCurso = $row2['nomeCurso'];
$turno = $row2['turno'];
$nomeDisciplina = $row2['nomeDisciplina'];
$numeroDiario = $row2['numeroDiario'];


 $doc_body ="
 <html xmlns:v='urn:schemas-microsoft-com:vml'
 xmlns:o='urn:schemas-microsoft-com:office:office'
 xmlns:w='urn:schemas-microsoft-com:office:word'
 xmlns:m='http://schemas.microsoft.com/office/2004/12/omml'
 xmlns='http://www.w3.org/TR/REC-html40'>
 
 <head>
 <meta http-equiv=Content-Type content='text/html; charset=UTF-8'>
 <meta name=ProgId content=Word.Document>
 <meta name=Generator content='Microsoft Word 15'>
 <meta name=Originator content='Microsoft Word 15'>
 <link rel=File-List href='12-02_arquivos/filelist.xml'>
 <link rel=themeData href='12-02_arquivos/themedata.thmx'>
 <link rel=colorSchemeMapping href='12-02_arquivos/colorschememapping.xml'>

 </head>
 
 <body bgcolor=white lang=PT-BR style='tab-interval:35.4pt'>
 
 <div class=WordSection1>
 
 <p class=MsoNormal align=center style='text-align:center'><b><span
 style='font-size:12.0pt;font-family:'Arial',sans-serif'>PLANO DE AULA</span></b></p>
 
 
 
 <div align=center>
 
 <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
  style='border-collapse:collapse;mso-yfti-tbllook:1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;page-break-inside:avoid;
   height:19.3pt'>
   <td width=635 style='width:475.9pt;border:solid black 1.0pt;background:#D9D9D9;
   padding:0cm 3.5pt 0cm 3.5pt;height:19.3pt'>
   <p class=MsoNormal style='margin-top:3.0pt;margin-right:0cm;margin-bottom:
   3.0pt;margin-left:0cm;layout-grid-mode:char'><b><span style='font-size:12.0pt;
   font-family:'Arial',sans-serif'>IDENTIFICA&Ccedil;&Atilde;O</span></b></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:1;page-break-inside:avoid;height:19.9pt'>
   <td width=635 style='width:475.9pt;border:solid black 1.0pt;border-top:none;
   padding:0cm 3.5pt 0cm 3.5pt;height:19.9pt'>
   <p class=MsoNormal style='margin-top:3.0pt;margin-right:0cm;margin-bottom:
   3.0pt;margin-left:0cm;text-align:justify;layout-grid-mode:char'><b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'>Professor: </span></b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'>LAIDER LUCAS COMIN
   VIEIRA</span></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:2;page-break-inside:avoid;height:19.9pt'>
   <td width=635 style='width:475.9pt;border:solid black 1.0pt;border-top:none;
   padding:0cm 3.5pt 0cm 3.5pt;height:19.9pt'>
   <p class=MsoNormal style='margin-top:3.0pt;margin-right:0cm;margin-bottom:
   3.0pt;margin-left:0cm;text-align:justify;layout-grid-mode:char'><span
   class=SpellE><b><span style='font-size:12.0pt;font-family:'Arial',sans-serif'>Qtd</span></b></span><b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'>. Aulas: </span></b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'>".$qtd_aulas."</span></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:3;page-break-inside:avoid;height:19.9pt'>
   <td width=635 style='width:475.9pt;border:solid black 1.0pt;border-top:none;
   padding:0cm 3.5pt 0cm 3.5pt;height:19.9pt'>
   <p class=MsoNormal style='margin-top:3.0pt;margin-right:0cm;margin-bottom:
   3.0pt;margin-left:0cm;text-align:justify;layout-grid-mode:char'><b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'>Data:</span></b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'> ".$dt_aulas." - ( ".$inicio_aula." às ".$termino_aula.")</span></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:4;page-break-inside:avoid;height:19.9pt'>
   <td width=635 style='width:475.9pt;border:solid black 1.0pt;border-top:none;
   padding:0cm 3.5pt 0cm 3.5pt;height:19.9pt'>
   <p class=MsoNormal style='margin-top:3.0pt;margin-right:0cm;margin-bottom:
   3.0pt;margin-left:0cm;text-align:justify;layout-grid-mode:char'><b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'>Turma:</span></b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'> ".$ano."º ".$ano_semestre." - ".$nomeCurso." - ".$turno." - ".$numeroDiario."</span></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:5;page-break-inside:avoid;height:19.9pt'>
   <td width=635 style='width:475.9pt;border:solid black 1.0pt;border-top:none;
   padding:0cm 3.5pt 0cm 3.5pt;height:19.9pt'>
   <p class=MsoNormal style='margin-top:3.0pt;margin-right:0cm;margin-bottom:
   3.0pt;margin-left:0cm;text-align:justify;layout-grid-mode:char'><b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'>Disciplina:</span></b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'> ".$nomeDisciplina." </span></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:6;mso-yfti-lastrow:yes;page-break-inside:avoid;
   height:19.9pt'>
   <td width=635 style='width:475.9pt;border:solid black 1.0pt;border-top:none;
   padding:0cm 3.5pt 0cm 3.5pt;height:19.9pt'>
   <p class=MsoNormal style='margin-top:3.0pt;margin-right:0cm;margin-bottom:
   3.0pt;margin-left:0cm;text-align:justify;layout-grid-mode:char'><b><span
   style='font-size:12.0pt;font-family:'Arial',sans-serif'>OBS: ".$obs." ".$obsTroca."</span></b></p>
   </td>
  </tr>
 </table>
 
 </div>
 
 <br>

 
 <div align=center>
 
 <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
  style='border-collapse:collapse;mso-yfti-tbllook:1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
   <td width=637 valign=top style='width:477.7pt;border:solid black 1.0pt;
   background:#CCCCCC;padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=MsoNormal style='layout-grid-mode:char'><b><span style='font-size:
   12.0pt;font-family:'Arial',sans-serif'>CONTE&Uacute;DO</span></b></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes;height:42.9pt'>
   <td width=637 valign=top style='width:477.7pt;border:solid black 1.0pt;
   border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:42.9pt'>
   <ul style='margin-top:0cm' type=disc>
    <li class=MsoNormal style='mso-list:l0 level1 lfo1;tab-stops:list 36.0pt;
        layout-grid-mode:char'><span style='font-size:12.0pt;font-family:'Arial',sans-serif;
        mso-fareast-font-family:'Times New Roman''>".$cont_min."</span><span style='mso-fareast-font-family:'Times New Roman''><o:p></o:p></span></li>
   
   </ul>
   <p class=MsoNormal style='margin-left:18.0pt;layout-grid-mode:char'>&nbsp;</p>
   </td>
  </tr>
 </table>
 
 </div>
 
<br>
 
 <div align=center>
 
 <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
  style='border-collapse:collapse;mso-yfti-tbllook:1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
   <td width=637 valign=top style='width:477.7pt;border:solid black 1.0pt;
   background:#CCCCCC;padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=MsoNormal style='layout-grid-mode:char'><b><span style='font-size:
   12.0pt;font-family:'Arial',sans-serif'>ATIVIDADES</span></b></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes;height:36.7pt'>
   <td width=637 valign=top style='width:477.7pt;border:solid black 1.0pt;
   border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:36.7pt'>
   <p class=MsoNormal style='layout-grid-mode:char'><span style='font-size:12.0pt;
   font-family:'Arial',sans-serif'>&nbsp;</span></p>
   <p class=MsoNormal style='layout-grid-mode:char'><span style='font-size:12.0pt;
   font-family:'Arial',sans-serif'></span></p>
   </td>
  </tr>
 </table>
 
 </div>
 
 <p class=MsoNormal>&nbsp;</p>
 
 <p class=MsoNormal align=center style='text-align:center'>&nbsp;</p>
 
 </div>
 
 </body>
 
 </html>
 
 ";
        
         header("Content-Type: application/vnd.msword");
         header("Expires: 0");//no-cache
         header("Cache-Control: must-revalidate, post-check=0, pre-check=0");//no-cache
         header("content-disposition: attachment;filename=".date('d-m-y').".doc");          
         echo "<html>";
         echo "$doc_body";
         echo "</html>";    
}




// volta para a pagina de cadastro de aulas
header('Location:../adicionar/add_aulas.php');
?>