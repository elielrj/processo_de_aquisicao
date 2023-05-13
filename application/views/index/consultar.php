<form class="user" id="form" action="index.php/ConsultarController/consultar" method="POST">

    <!--  Nup/Nud -->
    <div class="form-group">
        <input type="text" class="form-control form-control-user inputs register" id="numero"
            placeholder="Digite o Nup/Nud" name="numero" required>
    </div>
    
    <!--  Nup/Nud Errado -->
    <?php
    if (isset($_SESSION['numero_valido'])):
        if (!$_SESSION['numero_valido']):

            ?>
            <div class='form-group'>
                <p>Email inválido!</p>
            </div>


            <?php
        endif;
    endif;
    ?>

    <!--  Chave -->
    <div class="form-group">
        <input type="text" class="form-control form-control-user inputs register" id="chave"
            placeholder="Digite Chave de Acesso" name="chave" required>
    </div>

    <!--  Chave Errada -->
    <?php
    if (isset($_SESSION['chave_valida'])):
        if (!$_SESSION['chave_valida']):

            ?>
            <div class='form-group'>
                <p>Email inválido!</p>
            </div>


            <?php
        endif;
    endif;
    ?>

    <!--  Botão Consultar -->
    <input class="form-group btn btn-primary btn-user btn-block" type="submit" value="Consultar">
</form>