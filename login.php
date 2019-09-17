<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SGCA - SISTEMA DE GESTÃO E CONTROLE DE AULA</title>


    <!-- Styles -->
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-logo">
                            <h2>SGCA - Sistema de Gestão e Controle de Aulas</h2>
                            <br>
                        </div>
                        <div class="login-form">
                            <h4>LOGIN</h4>
                            <form action="valida.php" method="POST">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="usuario" id="usuario" type="text" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input name="senha" id="senha" type="password" class="form-control" placeholder="Senha">
                                </div>
                                <div class="checkbox">

                                    <label class="pull-right">
                                        <a href="#">Esqueceu a Senha?</a>
                                    </label>

                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">ENTRAR</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>