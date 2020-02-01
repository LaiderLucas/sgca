<body>
    <?php

require_once('core/menu.php');

?>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="login-content">

                <div class="login-form">
                    <h4>Cadastro de Novo Usuário</h4>
                    <form action="inserir/inserir_usuario.php" method="POST">
                        <div class="form-group">
                            <label>Nome de Usuário</label>
                            <input type="text" name="user" id="user" class="form-control" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="email@email.com">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" placeholder="****">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Aceito os termos e politicas de uso!
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Cadastrar</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Já Possui Cadastro? <a href="login.php"> Faça o Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>