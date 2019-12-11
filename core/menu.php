
<script>
    
   function apagar()
{
var cookieI = document.cookie.split("; ");
expire = new Date((new Date()).getTime() - 1);
for (var i = 0; i < cookieI.length; i++) 
{
	var cookieData = cookieI[i].split("=")[0];
	cookieData += "=;expires=" + expire.toGMTString();
	document.cookie = cookieData; 
}
location.href="../login.php";
}
 
</script>
<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
//protecao(); 
?>
        <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
            <div class="nano">
                <div class="nano-content">
                    <div class="logo"><a href="../index.php"><span>SISTEMA DE GESTÃO E CONTROLE DE AULAS</span></a></div>
                    <ul>
                        <li class="label">MENU</li>
                        <li><a class="sidebar-sub-toggle"><i class="ti-home"></i> INICIO <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="../index.php">PÁGINA INICIAL</a></li>
                            </ul>
                        </li>

                        <li class="label">LANÇAMENTO DE AULAS</li>
                        <li><a href="../adicionar/add_aulas.php"><i class="ti-pencil-alt"></i> Lançar Aulas</a></li>

                        <li class="label">CADASTROS E CONSULTAS</li>
                        <li><a class="sidebar-sub-toggle"><i class="ti-book"></i> Diários <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                            <li><a href="../adicionar/add_diarios.php">Cadastrar Diários </a></li>
                            <li><a href="../relatorio/rel_diarios.php">Diários Cadastrados</a></li>
                            </ul>

                            <li><a class="sidebar-sub-toggle"><i class="ti-marker"></i> Turmas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                            <li><a href="../adicionar/add_turmas.php">Cadastrar Turmas </a></li>
                            <li><a href="../relatorio/rel_turmas.php">Turmas Cadastradas</a></li>
                            </ul>

                            <li><a class="sidebar-sub-toggle"><i class="ti-bookmark-alt"></i> Cursos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                            <li><a href="../adicionar/add_cursos.php">Cadastrar Cursos </a></li>
                            <li><a href="../relatorio/rel_cursos.php">Cursos Cadastrados</a></li>
                            </ul>

                            <li><a class="sidebar-sub-toggle"><i class="ti-bookmark"></i> Disciplinas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                            <li><a href="../adicionar/add_disciplinas.php">Cadastrar Disciplinas </a></li>
                            <li><a href="../relatorio/rel_disciplinas.php">Disciplinas Cadastradas</a></li>
                            </ul>


                            <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> Alunos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                            <li><a href="../adicionar/add_alunos.php">Cadastrar Alunos </a></li>
                            <li><a href="../relatorio/rel_alunos.php">Alunos Cadastrados</a></li>
                            </ul>
                            <li><a href="../adicionar/add_matricula.php"><i class="ti-check-box"></i> Matricular Alunos No Diário</a>
                        
                        <li class="label">NOTAS E PRESENÇAS</li>
                        <li><a class="sidebar-sub-toggle"><i class="ti-plus"></i> Notas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="../adicionar/add_notas.php">Lançar Notas</a></li>
                            </ul>
                        </li>
                       
                        <li class="label">CONFIGURAÇÕES DO SISTEMA</li>
                        <li><a class="sidebar-sub-toggle"><i class="ti-settings"></i> Configurações <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="../adicionar/add_usuarios.php">Cadastrar Usuários</a></li>
                                <li><a href="#">Perfil</a></li>
                            </ul>
                        </li>
                        <li><a href="login.php" onclick="apagar()" ><i class="ti-close"></i> Logout</a></li>
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

                                <li class="header-icon dib"><i class="ti-bell"></i>
                                    <div class="drop-down">
                                        <div class="dropdown-content-heading">
                                            <span class="text-left">Notificações Recentes</span>
                                        </div>
                                        <div class="dropdown-content-body">
                                            <ul>
                                                
                                                <li>
                                                    <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="../assets/images/avatar/3.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Mr. John</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                                </li>
                                                <li class="text-center">
                                                    <a href="#" class="more-link">See All</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="header-icon dib"><i class="ti-email"></i>
                                    <div class="drop-down">
                                        <div class="dropdown-content-heading">
                                            <span class="text-left">2 Novas Mensagens</span>
                                            <a href="email.html"><i class="ti-pencil-alt pull-right"></i></a>
                                        </div>
                                        <div class="dropdown-content-body">
                                            <ul>
                                                
                                                <li class="notification-unread">
                                                    <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="../assets/images/avatar/2.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Mr. John</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                                </li>
                                                
                                                <li class="text-center">
                                                    <a href="#" class="more-link">See All</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="header-icon dib"><span class="user-avatar"><?php echo $_COOKIE['Nome'];?> <i class="ti-angle-down f-s-10"></i></span>
                                    <div class="drop-down dropdown-profile">
                                       
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li><a href="#"><i class="ti-user"></i> <span>Perfil</span></a></li>

                                            
                                                <li><a href="#"><i class="ti-settings"></i> <span>Configurações</span></a></li>

                                                
                                                <li><a href="#" onclick="apagar()"><i class="ti-power-off"></i> <span>Sair</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>