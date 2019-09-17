<?php
/*
### Gerador de Relat�rio Autom�tico ###
*/
class relatorios_dinamicos
{
    private $sql;
    private $tabela;
    private $lista_tipos;

    //nesta funcao, aconselha-se passar o m�todo da classe bancodedados->executa_sql como parametro
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

    private function gerarelatorio()
    {

        //Procura campos que possuam valores booleanos para colocar um SELECT BOX
        $lista_tipos = "";
        $l_cont = 0;
        foreach ($this->vetorCampos() as $tipos) {
            if (($tipos['tipo'] == 'bool' or $tipos['tipo'] == 'tinyint' or $tipos['tipo'] ==
                'int') and ($tipos['tamanho'] == 1)) {
                $this->lista_tipos .= "col_$l_cont: \"select\", \n";
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
                        $valor = 'N�O';
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
        $this->tabela = $tabela;
    }


    public function gerarelatoriohtml()
    {
        $this->gerarelatorio();
        $tabela = $this->tabela;
        $tabela .= "        
<script language=\"javascript\" type=\"text/javascript\">
//<![CDATA[
	var relatorio_Props = {
							$this->lista_tipos
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
       // $tabela .= "<br><br><center><a href=\"#\" onClick=\"window.print();return false\" class=\"fltrow\">Imprimir</a></center>";
	   $tabela .= "<p align='center'><a href=\"#\" onClick=\"window.print();return false\" class=\"fltrow\"><img src='../imagens/btImprimir.jpg' border='0' /></a></p>";
        print ($tabela);
    }

    public function gerarelatorioxls($id)
    {
        header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=relatorio$id.xls");
        header("Content-Description: Relatorio SIGETI");
        /*
        header("Content-type: application/vnd.ms-excel");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=relatorio$id.xls");
        header("Pragma: no-cache");
        */
        header("Expires: 0");
        $this->gerarelatorio();
        print ($this->tabela);
    }
}
?>