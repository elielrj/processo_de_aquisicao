<!-- Nav Item - Utilities Collapse Processos -->
<?php
include_once('application/models/bo/nivel_de_acesso/Root.php');
include_once('application/models/bo/nivel_de_acesso/Escritor.php');
?>
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
	   aria-controls="collapseThree">
		<i class="fas fa-fw fa-wrench"></i>
		<span>Processos</span>
	</a>
	<div id="collapseThree" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Opções:</h6>
			<?php if (
				$_SESSION['funcao_nivel_de_acesso'] === Escritor::NOME ||
				$_SESSION['funcao_nivel_de_acesso'] === Root::NOME
			): ?>
				<a class="collapse-item" href="<?php echo base_url('index.php/processo-novo'); ?>">Novo</a>
			<?php endif; ?>
			<a class="collapse-item" href="<?php echo base_url('index.php/processo-listar'); ?>">Todos Processos</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/processo-listar-todos-incompleto'); ?>">Processos Incompletos</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/processo-listar-todos-completo'); ?>">Processos Completos</a>
			<?php if($_SESSION['funcao_nivel_de_acesso'] === Escritor::NOME):  ?>
			<a class="collapse-item" href="<?php echo base_url('index.php/processo-listar-por-sc'); ?>">Processos do <?php echo $_SESSION['departamento_nome']; ?></a>
			<?php endif; ?>
		</div>
	</div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

