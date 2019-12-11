<?php
require_once 'config.php';
date_default_timezone_set('America/Cuiaba');
$date = date('Y-m-d');
$time = date('H:i:s');
$ip = getenv("REMOTE_ADDR"); //linha que captura o ip do usuario.
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$_POST['senha'] = sha1($_POST['senha']);

// Inclui o arquivo com o sistema de segurança
require_once("seguranca.php");

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Salva duas variáveis com o que foi digitado no formulário
  // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
 // Utiliza uma função criada no seguranca.php pra validar os dados digitados
  if (validaUsuario($usuario, $senha) == true) {
    // O usuário e a senha digitados foram validados, manda pra página interna

 
$PDO = db_connect(); // abre a conexão
// insere os dados do log na tabela e verifica se deu certo, se não chama a função expulsaVisitante
$sql = "INSERT INTO $banco.$tabela_log (`sga_logAcesso_usuario`, `sga_logAcesso_dataAcesso`, `sga_logAcesso_horaAcesso`, `sga_logAcesso_hostAcesso`, `sga_logAcesso_ipAcesso`) VALUES (:usuario, :data, :hora, :hostname, :ip)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':data', $date);
$stmt->bindParam(':hora', $time);
$stmt->bindParam(':hostname', $hostname);
$stmt->bindParam(':ip', $ip);


 
 
if ($stmt->execute())
{
  echo "<script>location.href='../index.php';</script>"; 
}
else
{
    echo "Erro ao insserir o Log";
    print_r($stmt->errorInfo());
}


  } else {
   
    expulsaVisitante();

    }
}
?>