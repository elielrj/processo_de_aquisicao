<!-- Sidebar -->

<?php
include_once('application/models/bo/nivel_de_acesso/Administrador.php');
include_once('application/models/bo/nivel_de_acesso/Root.php');
include_once('application/models/bo/nivel_de_acesso/Leitor.php');
include_once('application/models/bo/nivel_de_acesso/Escritor.php');

$administrador = $_SESSION['funcao_nivel_de_acesso'] === Administrador::NOME;
$root = $_SESSION['funcao_nivel_de_acesso'] == Root::NOME;

$posto_ou_raduacao_e_nome_de_guerra =
	(isset($_SESSION['nome_de_guerra']) && isset($_SESSION['hierarquia_sigla']))
		? ($_SESSION['hierarquia_sigla'] . " " . $_SESSION['nome_de_guerra'])
		: '';

$nivel_de_acesso = $_SESSION['funcao_nivel_de_acesso'] ?? '';

$acesso_ao_banco =
	isset($_SESSION['funcao_nivel_de_acesso']) &&
	($administrador || $root);
?>


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center"
	   href="<?php echo base_url('index.php/usuario-alterar-usuario') ?>">

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
			<p class="text-center p-0 m-1"><?php echo VERSAO_PROCESSO_DE_AQUISICAO ?></p>
		</div>
		<?php

		$controller = '';

		if (
			$_SESSION['funcao_nivel_de_acesso'] === Leitor::NOME ||
			$_SESSION['funcao_nivel_de_acesso'] === Escritor::NOME
		) {
			$controller = 'processo-listar-por-sc';
		} else {
			$controller = 'processo-listar';
		}

		?>
		<a class="nav-link" href="<?php echo base_url('index.php/' . $controller) ?>">
            <span>
                <img src="<?php echo base_url(); ?>icones_da_pagina/favicon-32x32.png" alt="Bootstrap" width="32"
					 height="32">
				iSALC
            </span>
		</a>

	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">


	<?php
	if (!$administrador) : ?>

		<!-- Heading -->
		<div class="sidebar-heading">Processos</div>

		<?php
		include_once('sidebar/processo.php');

	endif;
	?>



	<?php $acesso_ao_banco ? include_once('sidebar/banco_de_dados.php') : ''; ?>


	<!-- Heading -->
	<div class="sidebar-heading">Pregões</div>

	<?php include_once('sidebar/pregoes.php'); ?>

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
