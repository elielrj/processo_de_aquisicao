<!-- Sidebar -->

<?php 
    
    $posto_ou_raduacao_e_nome = 
        (isset($_SESSION['nome']) && isset($_SESSION['hierarquia_sigla'])) 
            ? ($_SESSION['hierarquia_sigla'] . " " . $_SESSION['nome']) 
            : ''; 

    $nivel_de_acesso = 
        isset($_SESSION['funcao_nivel_de_acesso']) 
            ? $_SESSION['funcao_nivel_de_acesso'] 
            : ''; 
    
?>


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <small><?php echo $posto_ou_raduacao_e_nome ?><sup><em><?php echo strtolower($nivel_de_acesso); ?></em></small></sup>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>iSALC </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Processos</div>

    <?php include_once('sidebar/processo.php'); ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php include_once('sidebar/bando_de_dados.php'); ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Configurações</div>

    <?php include_once('sidebar/configuracao_usuario.php'); ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src=<?php echo base_url('img/sugestao.png') ?> alt="...">
        <p class="text-center mb-2"><strong>Sugestão</strong> deixe aqui sua sugestão para que possamos melhorar!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Sugestão!</a>
    </div>

</ul>

<!-- End of Sidebar -->