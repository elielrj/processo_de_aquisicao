<form class="user" id="form" action="index.php/LoginController/logar" method="POST">


    <hr>


    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-1">Logar</h1>
    </div>

    <!-- email -->
    <div class="form-group">
        <input type="email" class="form-control form-control-user inputs register" id="email"
            aria-describedby="emailHelp" placeholder="Digite seu email..." name="email" autofocus required>
    </div>

    <!-- email Errado -->
    <?php
    if (isset($_SESSION['email_valido'])):
        if (!$_SESSION['email_valido']):

            ?>
            <div class='form-group'>
                <p>Email inválido!</p>
            </div>


            <?php
        endif;
    endif;

    ?>

    <!-- senha -->
    <div class="form-group">
        <input type="password" class="form-control form-control-user" id="senha" placeholder="Digite sua senha"
            name="senha" required>
    </div>

    <!-- senha Errada -->
    <?php
    if (isset($_SESSION['senha_valida'])):
        if (!$_SESSION['senha_valida']):
            ?>
            <div class='form-group'>
                <p>Senha inválida!</p>
            </div>

            <?php
        endif;
    endif;
    ?>


    <div class="form-group">
        <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="customCheck" checked>
            <label class="custom-control-label" for="customCheck">Lembre-me
            </label>
        </div>
    </div>

    <!--  Botão Login -->
    <input class="form-group btn btn-primary btn-user btn-block" type="submit" value="Login">

    <!--  LOGIN WITH TOKEN -->
    <a href="index.html" class="btn btn-facebook btn-user btn-block">
        <i class="fab fa-facebook-f fa-fw"></i> Login com Token
    </a>

    <hr>

    <div class="text-center">
        <a class="small" href="recuperarSenha.php">Esqueceu sua senha?</a>
    </div>

    <div class="text-center">
        <a class="small" href="criarUsuario.php">Criar conta!</a>
    </div>
</form>