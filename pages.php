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
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="Scripts/jQuery.js"></script>
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">

    <?php
require_once('core/config.php');
$pagina = $_COOKIE['routes'];
$path = strstr($pagina,'_', true);

if($path == 'add'){
    include('adicionar/'.$pagina.'.php');

}elseif($path == 'editar'){
    include('editar/'.$pagina.'.php');

}elseif($path == 'inserir'){
    include('inserir/'.$pagina.'.php');

}elseif($path == 'rel'){
    include('relatorio/'.$pagina.'.php');

}else{
    include('error.php');

};
?>
    <!-- Rodepé -->
    <?php
include('core/footer.php');
?>

    <!-- scripit init-->

    </body>
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
 

</html>