<!-- Sidebar -->

<?php

$posto_ou_raduacao_e_nome_de_guerra =
	(isset($_SESSION['nome_de_guerra']) && isset($_SESSION['hierarquia_sigla']))
		? ($_SESSION['hierarquia_sigla'] . " " . $_SESSION['nome_de_guerra'])
		: '';

$nivel_de_acesso = 	$_SESSION['funcao_nivel_de_acesso'] ?? '';

include_once('application/models/bo/Administrar.php');
include_once('application/models/bo/Root.php');


$acesso_ao_banco =
	isset($_SESSION['funcao_nivel_de_acesso']) &&
		(
			$_SESSION['funcao_nivel_de_acesso'] == Administrar::NOME ||
			$_SESSION['funcao_nivel_de_acesso'] == Root::NOME
		);
?>


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('index.php/usuario-alterar-usuario') ?>">

		<div class="sidebar-brand-text mx-3">
			<small>
				<?php echo $posto_ou_raduacao_e_nome_de_guerra ?><sup><em>
						<?php echo strtolower($nivel_de_acesso); ?>
					</em>
			</small></sup>
		</div>
	</a>


	</br>
	<!-- Nav Item - Dashboard -->

	<li class="nav-item active center">

		<div class="sidebar-card d-nome d-lg-flex p-1">
			<p class="text-center p-0 m-1">Versão 1.1.0/p>
		</div>

		<a class="nav-link" href="<?php echo base_url('index.php/processo-listar') ?>">
            <span>
                <img src="<?php echo base_url(); ?>icones_da_pagina/favicon-32x32.png" alt="Bootstrap" width="32"
					 height="32">
				iSALC
            </span>
		</a>

	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">Processos</div>

	<?php include_once('sidebar/processo.php'); ?>



	<?php $acesso_ao_banco ? include_once('sidebar/bando_de_dados.php') : ''; ?>


	<!-- Heading -->
	<div class="sidebar-heading">Configurações</div>

	<?php include_once('sidebar/configuracao_usuario.php'); ?>


	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

	<!-- Sidebar Message -->
	<div class="sidebar-card d-none d-lg-flex">
		<img class="sidebar-card-illustration mb-2" src=<?php echo base_url('img/sugestao.png') ?> alt="...">
		<p class="text-center mb-2"><strong>Sugestão</strong> deixe aqui sua sugestão para que possamos melhorar!</p>
		<a class="btn btn-success btn-sm"
		   href="<?php echo base_url('index.php/SugestaoController/novo') ?>">Sugestão!</a>
	</div>

</ul>

<!-- End of Sidebar -->
