<!-- Nav Item - Utilities Collapse Usuários -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Usuário</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Novo:</h6>

            <a class="collapse-item" href="<?php echo base_url('index.php/UsuarioController/alterarUsuario/' . $_SESSION['id']); ?>">Atualizar dados</a>
        </div>
    </div>
</li>