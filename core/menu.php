<script>
function apagar() {
    var cookieI = document.cookie.split("; ");
    expire = new Date((new Date()).getTime() - 1);
    for (var i = 0; i < cookieI.length; i++) {
        var cookieData = cookieI[i].split("=")[0];
        cookieData += "=;expires=" + expire.toGMTString();
        document.cookie = cookieData;
    }
    location.href = "login.php";
}


function setPageCookie(page) {
    document.cookie = "routes=" + page;
}
</script>
<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protecao(); 
?>
<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <div class="logo"><a href="index.php"><span>SISTEMA DE GESTÃO E CONTROLE DE AULAS</span></a></div>
            <ul>
                <li class="label">MENU</li>
                <li><a class="sidebar-sub-toggle"><i class="ti-home"></i> INICIO <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="index.php">PÁGINA INICIAL</a></li>
                    </ul>
                </li>

                <li class="label">LANÇAMENTO DE AULAS</li>
                <li><a href="pages.php" onclick="setPageCookie('add_aulas')"><i class="ti-pencil-alt"></i> Lançar
                        Aulas</a></li>

                <li class="label">CADASTROS E CONSULTAS</li>
                <li><a class="sidebar-sub-toggle"><i class="ti-book"></i> Diários <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="pages.php" onclick="setPageCookie('add_diarios')">Cadastrar Diários </a></li>
                        <li><a href="pages.php" onclick="setPageCookie('rel_diarios')">Diários Cadastrados</a></li>
                    </ul>

                <li><a class="sidebar-sub-toggle"><i class="ti-marker"></i> Turmas <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="pages.php" onclick="setPageCookie('add_turmas')">Cadastrar Turmas </a></li>
                        <li><a href="pages.php" onclick="setPageCookie('rel_turmas')">Turmas Cadastradas</a></li>
                    </ul>

                <li><a class="sidebar-sub-toggle"><i class="ti-bookmark-alt"></i> Cursos <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="pages.php" onclick="setPageCookie('add_cursos')">Cadastrar Cursos </a></li>
                        <li><a href="pages.php" onclick="setPageCookie('rel_cursos')">Cursos Cadastrados</a></li>
                    </ul>

                <li><a class="sidebar-sub-toggle"><i class="ti-bookmark"></i> Disciplinas <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="pages.php" onclick="setPageCookie('add_disciplinas')">Cadastrar Disciplinas </a>
                        </li>
                        <li><a href="pages.php" onclick="setPageCookie('rel_disciplinas')">Disciplinas Cadastradas</a>
                        </li>
                    </ul>

                <li class="label">CONFIGURAÇÕES DO SISTEMA</li>
                <li><a class="sidebar-sub-toggle"><i class="ti-settings"></i> Configurações <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="pages.php" onclick="setPageCookie('add_usuarios')">Cadastrar Usuários</a></li>
                        <li><a href="#">Perfil</a></li>
                    </ul>
                </li>
                <li><a href="login.php" onclick="apagar()"><i class="ti-close"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>


<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-left">
                    <div class="hamburger sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="float-right">
                    <ul>
                        <li class="header-icon"><span class="user-avatar"><?php echo $_COOKIE['Nome'];?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>