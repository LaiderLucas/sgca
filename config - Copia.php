<?php

//config geral

// constantes com as credenciais de acesso ao banco MySQL

define('DB_HOST', '35.231.252.51');

define('DB_USER', 'root');

define('DB_PASS', 'P@$$word');

define('DB_NAME', 'sga');



	

define('HOST','35.231.252.51');
define('USER','root');
define('PASS','P@$$word');
define('BD','sga');





// Classe de Conexão com o banco de dados

function db_connect()

{
	
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);


    return $PDO;

}



//====================================================================================================



?>