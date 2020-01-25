<?php
$pagina = $_GET['id'];
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