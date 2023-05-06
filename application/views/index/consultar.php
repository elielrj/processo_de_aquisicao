<form class="user" id="form" action="index.php/ConsultarController/consultar" method="POST">
    <!--  Nup/Nud -->
    <div class="form-group">
        <input type="text" class="form-control form-control-user inputs register" id="numero"
            placeholder="Digite o Nup/Nud" name="numero" required>
    </div>
    <!--  Chave -->
    <div class="form-group">
        <input type="text" class="form-control form-control-user inputs register" id="chave"
            placeholder="Digite Chave de Acesso" name="chave" required>
    </div>

    <!--  Botão Consultar -->
    <input class="form-group btn btn-primary btn-user btn-block" type="submit" value="Consultar">
</form>