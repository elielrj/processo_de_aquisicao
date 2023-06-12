<!-- Heading -->
<div class="sidebar-heading">
	Banco de Dados
</div>

<!-- Nav Item - Pages Collapse collapseAndamento -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAndamento" aria-expanded="true"
	   aria-controls="collapseAndamento">
		<i class="fas fa-fw fa-cog"></i>
		<span>Andamento</span>
	</a>
	<div id="collapseAndamento" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Andamento dos processos</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/andamento-listar'); ?>">Listar</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Arquivos -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArquivos" aria-expanded="true"
	   aria-controls="collapseArquivos">
		<i class="fas fa-fw fa-cog"></i>
		<span>Arquivo</span>
	</a>
	<div id="collapseArquivos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Arquivos dos processos</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/arquivo-listar'); ?>">Listar</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Artefatos -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArtefatos" aria-expanded="true"
	   aria-controls="collapseArtefatos">
		<i class="fas fa-fw fa-cog"></i>
		<span>Artefato</span>
	</a>
	<div id="collapseArtefatos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Processo de Aquisição</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/artefatos'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/artefatos/novo'); ?>">Novo</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/artefatos/listar'); ?>">Alterar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/artefatos/listar'); ?>">Deletar</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Departamento -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDepartamentos"
	   aria-expanded="true"
	   aria-controls="collapseDepartamentos">
		<i class="fas fa-fw fa-cog"></i>
		<span>Departamento</span>
	</a>
	<div id="collapseDepartamentos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Seções da UASG</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/departamento-listar'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/departamento-novo'); ?>">Novo</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Lei -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeis" aria-expanded="true"
	   aria-controls="collapseLeis">
		<i class="fas fa-fw fa-cog"></i>
		<span>Lei</span>
	</a>
	<div id="collapseLeis" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Processo de Aquisição</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/leis'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/leis/novo'); ?>">Novo</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/leis/listar'); ?>">Alterar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/leis/listar'); ?>">Deletar</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse collapseLeiTipoArtefato -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeiTipoArtefato"
	   aria-expanded="true"
	   aria-controls="collapseLeiTipoArtefato">
		<i class="fas fa-fw fa-cog"></i>
		<span>Lei/Tipo/Artefato</span>
	</a>
	<div id="collapseLeiTipoArtefato" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Processo de Aquisição</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/leis-tipos-artefatos'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/usuarios/novo'); ?>">Novo</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/usuarios/listar'); ?>">Alterar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/usuarios/listar'); ?>">Deletar</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Modalidade -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseModalidade" aria-expanded="true"
	   aria-controls="collapseModalidade">
		<i class="fas fa-fw fa-cog"></i>
		<span>Modalidade</span>
	</a>
	<div id="collapseModalidade" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Processo de Aquisição</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/modalidades'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/modalidades/novo'); ?>">Novo</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/modalidades/listar'); ?>">Alterar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/modalidades/listar'); ?>">Deletar</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Processo -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProcesso" aria-expanded="true"
	   aria-controls="collapseProcesso">
		<i class="fas fa-fw fa-cog"></i>
		<span>Processo</span>
	</a>
	<div id="collapseProcesso" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Processo de Aquisição</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/processo-listar'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/processo-novo'); ?>">Novo</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Tipo -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTipo" aria-expanded="true"
	   aria-controls="collapseTipo">
		<i class="fas fa-fw fa-cog"></i>
		<span>Tipo</span>
	</a>
	<div id="collapseTipo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Processo de Aquisição</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/tipos'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/tipos/novo'); ?>">Novo</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/tipos/listar'); ?>">Alterar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/tipos/listar'); ?>">Deletar</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Ug -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUg" aria-expanded="true"
	   aria-controls="collapseUg">
		<i class="fas fa-fw fa-cog"></i>
		<span>Ug</span>
	</a>
	<div id="collapseUg" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Processo de Aquisição</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/ugs'); ?>">Ug</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/ugs'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/ugs/novo'); ?>">Novo</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/ugs/listar'); ?>">Alterar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/ugs/listar'); ?>">Deletar</a>
		</div>
	</div>
</li>

<!-- Nav Item - Pages Collapse Usuário -->
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuario" aria-expanded="true"
	   aria-controls="collapseUsuario">
		<i class="fas fa-fw fa-cog"></i>
		<span>Usuário</span>
	</a>
	<div id="collapseUsuario" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<h6 class="collapse-header">Processo de Aquisição</h6>
			<a class="collapse-item" href="<?php echo base_url('index.php/usuario-listar'); ?>">Listar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/usuario-novo'); ?>">Novo</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/UsuarioController/listarAtivos'); ?>">Desativar</a>
			<a class="collapse-item" href="<?php echo base_url('index.php/UsuarioController/listarDesativados'); ?>">Ativar</a>
		</div>
	</div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
