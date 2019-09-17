<?php

function criptoCesar($str, $shift)
{
    $char = range('a', 'z');
    $flip = array_flip($char);

    for ($i = 0; $i < strlen($str); $i++) {
        if (in_array(strtolower($str{$i}), $char)) {
            $ord = $flip[strtolower($str{$i})];

            $ord = ($ord + $shift) % 26;

            if ($ord < 0) $ord += 26;

            $str{$i} = ($str{$i} == strtolower($str{$i})) ? $char[$ord]
                                                          : strtoupper($char[$ord]);
        }
    }

    return $str;
}

//config geral

// constantes com as credenciais de acesso ao banco MySQL

define('DB_HOST', 'localhost');

define('DB_USER', 'root');

define('DB_PASS', '');

define('DB_NAME', 'sga');

// Definindo banco e tabelas
$base_teste = false;
$banco = "sga";
$tabela_aulas = "sga_aulas";
$tabela_aluno = "sga_aluno";
$tabela_curso = "sga_curso";
$tabela_diario = "sga_diario";
$tabela_disciplina = "sga_disciplina";
$tabela_horarioaula = "sga_horarioaula";
$tabela_matricula = "sga_matricula";
$tabela_presencas = "sga_presencas";
$tabela_trocas = "sga_trocas";
$tabela_turma = "sga_turma";
$tabela_usuarios = "sga_usuarios";
$tabela_log = "sga_logacesso";
$tabela_bim_sem = "sga_bim_sem";





// Classe de Conexão com o banco de dados

function db_connect()

{
	
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);


    return $PDO;

}

//====================================================================================================

if ($base_teste == true) {

    echo "
    <h2 style='color:red; text-align: center;'>BASE DE DADOS TESTE</h2> 
    ";
}
