<?php
include('../core/config.php');
include("../core/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 


$email = $_POST['email'];
$user = $_POST['user'];
$senha = sha1($_POST['senha']);



$PDO = db_connect();


$sql="INSERT INTO `$banco`.`$tabela_usuarios` (`sga_usuarios_Nome`, `sga_usuarios_Login`, `sga_usuarios_Senha`) VALUES (:user, :email, :senha);
;
";

$stmt = $PDO->prepare($sql);
$stmt->BindParam(':user', $user);
$stmt->BindParam(':email',$email);
$stmt->BindParam(':senha', $senha);


if ($stmt->execute()){
	$_SESSION['sucesso'] = 1;
}else {
	$_SESSION['sucesso'] = 0;
	$_SESSION['aviso'] = "ERRO AO CADASTRAR USUARIO!";
	print_r($stmt);	
die;
}

?>
<script>
window.location.href = "http://localhost/teste/pages.php";
</script>