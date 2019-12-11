<?php
require_once 'config.php';
//  Configurações do Script
// ==============================

// Verifica se precisa fazer a conexão com o MySQL

// Verifica se precisa iniciar a sessão
/**
 * Função que valida um usuário e senha
 *
 * @param string $usuario - O usuário a ser validado
 * @param string $senha - A senha a ser validada
 *
 * @return bool - Se o usuário foi validado ou não (true/false)
 */
function validaUsuario($usuario, $senha)
{
  global $_SG;
  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
  // Usa a função addslashes para escapar as aspas
  $nusuario = addslashes($usuario);
  $nsenha = addslashes($senha);
  // Monta uma consulta SQL (query) para procurar um usuário
  $PDO = db_connect();
  $sql = "SELECT `sga_usuarios_Login`, `sga_usuarios_Senha`, `sga_usuarios_Nome`,`sga_usuarios_ID` FROM sga_usuarios WHERE `sga_usuarios_Login` = '" . $nusuario . "' AND  `sga_usuarios_Senha` = '" . $nsenha . "';";
  $stmt = $PDO->prepare($sql);
  $stmt->execute();
  $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
  if (empty($resultado)) {
    // Nenhum registro foi encontrado => o usuário é inválido
    return false;
  } else {
    // Definimos dois valores na sessão com os dados do usuário
    $sga_usuarios_ID = base64_encode($resultado['sga_usuarios_ID']);
    $sga_usuarios_Login = $resultado['sga_usuarios_Login'];
    $sga_usuarios_Nome = $resultado['sga_usuarios_Nome'];


    setcookie('SID', $sga_usuarios_ID, time() + 3600, "/teste"); // Pega o valor da coluna 'id do registro encontrado no MySQL
    setcookie('UID',  $sga_usuarios_Login, time() + 3600, "/teste"); // Pega o valor da coluna 'nome' do registro encontrado no MySQL
    setcookie('Nome', $sga_usuarios_Nome, time() + 3600, "/teste");
    // Verifica a opção se sempre validar o login
    if ($_SG['validaSempre'] == true) {
      // Definimos dois valores na sessão com os dados do login
      setcookie('usuarioLogin', $usuario);
      setcookie('usuarioSenha', $senha);
    }
    return true;
  }
}
/**
 * Função que protege uma página
 */
function protegePagina()
{
  global $_SG;
  if (!isset($_COOKIE['SID']) or !isset($_COOKIE['UID'])) {
    // Não há usuário logado, manda pra página de login
    expulsaVisitante();
  } else if (!isset($_COOKIE['SID']) or !isset($_COOKIE['UID'])) {
    // Há usuário logado, verifica se precisa validar o login novamente
    if ($_SG['validaSempre'] == true) {
      // Verifica se os dados salvos na sessão batem com os dados do banco de dados
      if (!validaUsuario($_COOKIE['usuarioLogin'], $_COOKIE['usuarioSenha'])) {
        // Os dados não batem, manda pra tela de login
        expulsaVisitante();
      }
    }
  }
}



function protecao()
{
  global $_SG;
  if (!isset($_COOKIE['SID']) or !isset($_COOKIE['UID'])) {
    // Não há usuário logado, manda pra página de login
    aviso();
  } else if (!isset($_COOKIE['SID']) or !isset($_COOKIE['UID'])) {
    // Há usuário logado, verifica se precisa validar o login novamente
    if ($_SG['validaSempre'] == true) {
      // Verifica se os dados salvos na sessão batem com os dados do banco de dados
      if (!validaUsuario($_COOKIE['usuarioLogin'], $_COOKIE['usuarioSenha'])) {
        // Os dados não batem, manda pra tela de login
        aviso();
      }
    }
  }
}
/**
 * Função para expulsar um visitante
 */
function expulsaVisitante()
{
  global $_SG;
  // Remove as variáveis da sessão (caso elas existam)
  unset($_COOKIE['SID'], $_COOKIE['UID'], $_COOKIE['usuarioLogin'], $_COOKIE['usuarioSenha']);
  // Manda pra tela de login


  //header("Location: ".$_SG['paginaLogin']);
  ?>

<SCRIPT Language="javascript">
  alert('Usu\xE1rio/Senha Inv\xE1lidos. Tente novamente !!');
  location.href = '../login.php';
</SCRIPT>

<?php

}



function aviso()
{
  global $_SG;
  // Remove as variáveis da sessão (caso elas existam)
  unset($_COOKIE['SID'], $_COOKIE['UID'], $_COOKIE['usuarioLogin'], $_COOKIE['usuarioSenha']);
  // Manda pra tela de login


  //header("Location: ".$_SG['paginaLogin']);
  ?>
<SCRIPT Language="javascript">
  location.href = 'login.php';
</SCRIPT>

<?php

}

?>