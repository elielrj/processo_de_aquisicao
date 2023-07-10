<!-- Nav Item - Utilities Collapse Processos -->

<?php
include_once('application/models/bo/nivel_de_acesso/Leitor.php');
include_once('application/models/bo/nivel_de_acesso/Escritor.php');
include_once('application/models/bo/nivel_de_acesso/Executor.php');
include_once('application/models/bo/nivel_de_acesso/Conformador.php');
include_once('application/models/bo/nivel_de_acesso/Root.php');

$leitor = $_SESSION['funcao_nivel_de_acesso'] === Leitor::NOME;
$escritor = $_SESSION['funcao_nivel_de_acesso'] === Escritor::NOME;
$executor = $_SESSION['funcao_nivel_de_acesso'] === Executor::NOME;
$conformador = $_SESSION['funcao_nivel_de_acesso'] === Conformador::NOME;
$root = $_SESSION['funcao_nivel_de_acesso'] === Root::NOME;
?>

<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
	   aria-controls="collapseThree">
		<i class="fa fa-book"></i>
		<span>Processos</span>
	</a>
	<div id="collapseThree" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Opções:</h6>

			<?php ($escritor || $executor || $root) ? include_once 'processo_novo.php' : '' ?>
			<?php ($executor || $conformador || $root) ? include_once 'processo_listar_todos.php' : '' ?>
			<?php ($escritor || $leitor ||$root) ? include_once 'processo_listar_por_demandante.php' : '' ?>
			<?php ($executor || $root) ? include_once 'processo_listar_todos.php' : '' ?>
			<?php ($executor || $root) ? include_once 'processo_listar_todos_competos.php' : '' ?>
			<?php ($executor || $root) ? include_once 'processo_listar_todos_incompletos.php' : '' ?>
			<?php ($executor || $root) ? include_once 'processo_listar_todos_excluidos.php' : '' ?>

		</div>
	</div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

