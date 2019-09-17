<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Relatório SIGETI</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--style type="text/css" media="print">
.fltrow{
	display: none;
}
</style-->

<style type="text/css">
th{ background-color:#4f9633; color:#FFF; padding:2px; border:1px solid #ccc; }
body{ 
	margin:15px; padding:15px;
	font-family:Arial, Helvetica, sans-serif; font-size:88%; 
}
h2{ margin-top: 50px; }
caption{ margin:10px 0 0 5px; padding:10px; text-align:left; }
pre{ font-size:13px; margin:5px; padding:5px; background-color:#f4f4f4; border:1px solid #ccc;  }
.mytable{
	width:100%; font-size:12px;
	border:1px solid #ccc;
}
div.tools{ margin:5px; }
div.tools input{ background-color:#f4f4f4; border:2px outset #f4f4f4; margin:2px; }
td{ padding:2px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; }
</style>

<style type="text/css" media="screen">
@import "library/tablefilter/filtergrid.css";
</style>

<style type="text/css" media="print">
@import "library/tablefilter/filtergrid_print.css";
</style>


<script language="javascript" type="text/javascript" src="library/tablefilter/actb.js"></script><!-- External script -->
<script language="javascript" type="text/javascript" src="library/tablefilter/tablefilter.js"></script>
</head>
<body>

<?php
require_once("Relatorio.class.php");
include('config.php');

$PDO = db_connect();
$sql = "SELECT * FROM sga_aulas";
$stmt = $PDO->prepare($sql);
$stmt->execute();

if($stmt->rowCount() ==1)
{
//$fetch = mysql_fetch_array($query);

//$sql_relatorio = $fetch['sqlRelatorio'];
//$query_relatorio = mysql_query($sql_relatorio, $localhost) or die(mysql_error());
$sql = "SELECT * FROM sga_aulas";
$query_relatorio = $PDO->prepare($sql);
$query_relatorio->execute();
?>


<?php

$relatorio = new relatorios_dinamicos($query_relatorio);
$relatorio->gerarelatoriohtml();
}
else
{
	print("<b><font color=red>Relat�rio n�o cadastrado!!!</font></b>");
}
?>

</body>
</html>