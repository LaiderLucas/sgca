<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Classes PHP - Grid dinamica</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--style type="text/css" media="print">
.fltrow{
	display: none;
}
</style-->

<style type="text/css" media="screen">
/*====================================================
	- HTML Table Filter stylesheet
=====================================================*/
@import "filtergrid.css";

/*====================================================
	- General html elements
=====================================================*/
body{ 
	margin:15px; padding:15px; border:1px solid #666;
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
th{ background-color:#003366; color:#FFF; padding:2px; border:1px solid #ccc; }
td{ padding:2px; border-bottom:1px solid #ccc; border-right:1px solid #ccc; }

</style>
<script language="javascript" type="text/javascript" src="actb.js"></script><!-- External script -->
<script language="javascript" type="text/javascript" src="tablefilter.js"></script>
</head>
<body>

<?php

//**   Desenvolvido por Paulo Henrique Bueno Lopes   **//
//**   paulohbl@gmail.com							 **//
//**   Cuiabá, 18 de agosto de 2008					 **//
//**   SEDUC - MT									 **//


//Classe utilizada para conexão ao banco
//Possui métodos genericos de consultas em qualquer tabela
class bancodedados
{

    //################MYSQL#####################
    //private $mysql_servidor = '10.112.1.17'; //guarda o host de conexao com o banco mysql
    //private $mysql_usuario = 'sigeti'; //guarda o usuario de conexao com o banco mysql
    //private $mysql_senha = 'jgtryo'; //guarda a senha de conexao com o banco mysql
    //private $mysql_porta = '13308'; //guarda a porta de conexao com o banco mysql
    //private $mysql_basededados; //guarda a base de dados do banco
    //private $mysql_conexao; //guarda o link de conexão do banco de dados
    //##########################################

    //################MYSQL#####################
    //private $mysql_servidor = 'seducmt03001017.seduc.mt.gov.br'; //guarda o host de conexao com o banco mysql
    //private $mysql_usuario = 'redmine'; //guarda o usuario de conexao com o banco mysql
    //private $mysql_senha = 'fyskc0oq'; //guarda a senha de conexao com o banco mysql
    //private $mysql_porta = '23308'; //guarda a porta de conexao com o banco mysql
    private $mysql_basededados; //guarda a base de dados do banco
    private $mysql_conexao; //guarda o link de conexão do banco de dados
    //##########################################

    //################MYSQL#####################
    private $mysql_servidor = 'seducmt03001017.seduc.mt.gov.br';
    private $mysql_usuario = 'sigeti';
    private $mysql_porta = '23308';
    private $mysql_senha = 'zaxscd';
    //##########################################

    private $tipobanco; //guarda o tipo do banco que será utilizado (mysql,mssql e oracle)
    private $querysql; //guarda a instrução SQL que foi enviada pelo metodo executa_sql
    private $resultadosql;

    //Função que é executada ao instanciar a classe
    //Esta função conecta ao banco de dados e seleciona a database informada
    public function __construct($tipobanco, $basededados)
    {
        $this->tipobanco = $tipobanco;
        $this->mysql_basededados = $basededados;
        switch ($this->tipobanco) {
            case 'mysql':
                $this->mysql_conexao = mysql_pconnect("$this->mysql_servidor:$this->mysql_porta",
                    $this->mysql_usuario, $this->mysql_senha);
                ($this->mysql_conexao) or die("Erro ao conectar na base de dados");
                (mysql_select_db($this->mysql_basededados)) or die("Erro ao selecionar a base de dados");
                break;

            case 'mssql':
                print ("mssql");
                break;
            case 'oracle':
                print ("oracle");
                break;
        }
    }

    //Função que é executada ao destruir o objeto
    //Esta função fecha a conexão criada para este objeto
    public function __destruct()
    {
        switch ($this->tipobanco) {
            case 'mysql':
                mysql_close($this->conexao());
                break;
            case 'mssql':
                break;
            case 'oracle':
                break;
        }
    }

    //Função criada para alterar a base de dados
    public function altera_basededados($basededados)
    {
        switch ($this->tipobanco) {
            case 'mysql':
                (mysql_query("alter database $basededados", $this->mysql_conexao)) or die("Erro ao alterar a base de dados: $basededados");
                $this->basededados = $basededados;
                break;

            case 'mssql':
                print ("mssql");
                break;
            case 'oracle':
                print ("oracle");
                break;
        }
    }

    //Função criada para retornar a conexão criada, independente do banco de dados escolhido, em uma mesma variável, facilitando a implementação
    public function conexao()
    {
        switch ($this->tipobanco) {
            case 'mysql':
                return $this->mysql_conexao;
                break;

            case 'mssql':
                print ("mssql");
                break;
            case 'oracle':
                print ("oracle");
                break;
        }
    }

    public function retorna_query()
    {
        return $this->resultadosql;
    }

    //Função que executa um sql genérico
    public function executa_sql($sql)
    {
        $this->querysql = $sql;
        switch ($this->tipobanco) {
            case 'mysql':
                $query = (mysql_query($sql, $this->conexao())) or die("Erro ao executar a consulta:" .
                    mysql_error());
                $this->resultadosql = $query;
                return $query;
                break;

            case 'mssql':
                print ("mssql");
                break;
            case 'oracle':
                print ("oracle");
                break;
        }
    }

    //Função que retorna o ID da ultima inserção
    public function ultimoid()
    {
        switch ($this->tipobanco) {
            case 'mysql':
                return mysql_insert_id($this->conexao);
                break;

            case 'mssql':
                break;
            case 'oracle':
                break;
        }
    }

    //imprime o ultimo SQL utilizado
    public function imprime_sql()
    {
        if (!empty($this->querysql)) {
            print ($this->querysql);
        } else {
            print ("Nenhuma query foi executada para este objeto!</br>");
        }
    }

    public function erro()
    {
        switch ($this->tipobanco) {
            case 'mysql':
                return mysql_error();
                break;
            case 'mssql':
                return mssql_error();
                break;
            case 'oracle':
                break;
        }
    }
}

class relatorios_dinamicos
{
    private $sql;
    private $css;
    private $tabela;

    //nesta funcao, aconselha-se passar o método da classe bancodedados->executa_sql como parametro
    public function __construct($sql)
    {
        $this->sql = $sql;
    }

    public function getNumFields()
    {
        $fieldsnum = mysql_num_fields($this->sql);
        return $fieldsnum;
    }

    public function getNumRows()
    {
        $numrows = mysql_num_rows($this->sql);
        return $numrows;
    }

    public function vetorCampos()
    {
        for ($i = 0; $i < $this->getNumFields(); $i++) {
            $nome = mysql_field_name($this->sql, $i);
            $tamanho = mysql_field_len($this->sql, $i);
            $tipo = mysql_field_type($this->sql, $i);

            $vetor[$i]['nome'] = $nome;
            $vetor[$i]['tamanho'] = $tamanho;
            $vetor[$i]['tipo'] = $tipo;
        }
        return $vetor;
    }

    public function getCSS()
    {
        return $this->css;
    }

    public function setCSS($css = '')
    {
        $this->css = $css;
    }

    /*
    private function gerarelatorio()
    {
    $tabela = "";
    $tabela .= "<table cellpadding=3 cellspacing=5 width=95%>\n";
    $tabela .= "<tr>\n";
    foreach ($this->vetorCampos() as $campos) {
    $campos = strtoupper($campos['nome']);
    $tabela .= "	<th>";
    $tabela .= "$campos";
    $tabela .= "</th>\n";
    }
    $tabela .= "</tr>\n";

    while ($lista_dados = mysql_fetch_array($this->sql)) {
    $tabela .= "<tr>\n";
    foreach ($this->vetorCampos() as $campos) {
    $valor = $lista_dados["$campos[nome]"];
    $tabela .= "	<td>";
    $tabela .= "$valor";
    $tabela .= "</td>\n";
    }
    $tabela .= "</tr>\n";

    }

    $tabela .= "</table>\n";
    $this->tabela = $tabela;
    }
    */

    private function gerarelatorio()
    {

        //Procura campos que possuam valores booleanos para colocar um SELECT BOX
        $lista_tipos = "";
        $l_cont = 0;
        foreach ($this->vetorCampos() as $tipos) {
            if (($tipos['tipo'] == 'bool' or $tipos['tipo'] == 'tinyint' or $tipos['tipo'] ==
                'int') and ($tipos['tamanho'] == 1)) {
                $lista_tipos .= "col_$l_cont: \"select\", \n";
            }
            $l_cont++;
        }

        $tabela = "";
        $tabela .= "<table id=\"relatorio\" name=\"relatorio\" class=\"mytable\">\n";
        $tabela .= "<tr>\n";
        foreach ($this->vetorCampos() as $campos) {
            $campos = strtoupper($campos['nome']);
            $tabela .= "	<th>";
            $tabela .= "$campos";
            $tabela .= "</th>\n";
        }
        $tabela .= "</tr>\n";

        while ($lista_dados = mysql_fetch_array($this->sql)) {
            $tabela .= "<tr>\n";
            foreach ($this->vetorCampos() as $campos) {
            	$valor = $lista_dados["$campos[nome]"];
            	
                //Imprimir SIM/NAO para campos booleanos
                if (($campos['tipo'] == 'bool' or $campos['tipo'] == 'tinyint' or $campos['tipo'] ==
                    'int') and ($campos['tamanho'] == 1)) {
                    if ($lista_dados["$campos[nome]"] == 1) {
                        $valor = 'SIM';
                    } else {
                        $valor = 'NÃO';
                    }
                }
                // FIM SCRIPT   SIM/NAO
                
                $tabela .= "	<td>";
                $tabela .= "$valor";
                $tabela .= "</td>\n";
            }
            $tabela .= "</tr>\n";

        }

        $tabela .= "</table>\n";
        $tabela .= "        
<script language=\"javascript\" type=\"text/javascript\">
//<![CDATA[
	var relatorio_Props = {
							$lista_tipos
							rows_counter: true,
							loader: true,
							loader_text: \"Filtrando dados...\",
							display_all_text: \"[Todos]\",
							btn_reset: true,
							sort_select: true,
							alternate_rows: true,
							btn_reset_text: \"Limpar\"
						};
	setFilterGrid( \"relatorio\",relatorio_Props );
//]]>
</script>";

        $this->tabela = $tabela;
    }


    public function gerarelatoriohtml()
    {
        $this->gerarelatorio();
        $tabela = '';
        if (!empty($this->css)) {
            $tabela .= '<link href="' . $this->css . '" rel="stylesheet" type="text/css">';
        }

        $tabela .= $this->tabela;
        print ($tabela);
    }

    public function gerarelatorioxls()
    {
        header("Content-type: application/vnd.ms-excel");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=relatorio.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->gerarelatorio();
        print ($this->tabela);
    }

    public function gerarelatoriopdf()
    {

    }

    public function gera_layout($posicao)
    {
        //pega a lista de campos do SQL
        $vetorCampos = $this->vetorCampos();
        //pega os tipos dos campos
        foreach ($vetorCampos as $campos) {
            $lista_tipos[] = $campos['tipo'];
        }
        //retira os tipos duplicados
        $lista_tipos = array_unique($lista_tipos);
        //alinha em ordem alfabética
        asort($lista_tipos);
        //percorre o vetor de tipos
        foreach ($lista_tipos as $campos_tipo) {
            //percorre o vetor de campos
            foreach ($vetorCampos as $campos) {
                if ($campos_tipo == $campos['tipo']) {

                    switch ($campos['tipo']) {
                        case 'string':
                            print ("$campos[nome] : <input name='$campos[nome]' id='$campos[nome]' type='text' size='40' maxlength='$campos[tamanho]'> <br>\n");
                            break;
                        case 'int':
                            print ("DAMMIT!! INT <br>");
                            break;
                    }


                    //print ($campos['nome'] . ' <> ' . $campos['tipo'] . '<br>');
                }
            }

            //			switch ($vetorCampos['tipo']) {
            //            case 'string': print ("DAMMIT!! STRING <br>");
            //            case 'int': print ("DAMMIT!! INT <br>");
            //        }
        }


    }


}

$teste = new bancodedados('mysql', 'sigeti');
//$dados = $teste->executa_sql("select nomeSistemaOperacional SistemaOperacional, nomeVersao Versao, so_versao.ativo Ativo from so_versao, li_so where so_versao.idli_so = li_so.idli_so;");
$dados = $teste->executa_sql("select * from projeto;");
$relatorio = new relatorios_dinamicos($teste->retorna_query());
$relatorio->setCSS('tabela1.css');
$relatorio->gerarelatoriohtml();
?>

</body>
</html>