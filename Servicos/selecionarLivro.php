<?php
    error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    require_once '../config.php';
    require_once 'funcoes.php';
    $con = conectar();
    mysql_select_db('livrariaonline') or die(mysql_error());

    $id = $_POST['id'];

    $query = mysql_query("SELECT * FROM Livro WHERE Id = '".$id."'") or die(mysql_error());
    $linha = mysql_fetch_object($query);

?>

<form>
    <label>Nome: </label>
    <input type="text" class="form-control" placeholder="Insira o nome do livro" id="fEditarNome"
        value="<?php echo $linha->Nome ?>" /> <br>
    <label>Autor: </label>
    <input type="text" class="form-control" placeholder="Insira o autor do livro" id="fEditarAutor"
        value="<?php echo $linha->Autor ?>" />
    <br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Quantidade de Páginas: </label>
            <input type="text" class="form-control" placeholder="Insira a quantidade de páginas do livro"
                id="fEditarQtdPaginas" value="<?php echo $linha->QtdPaginas ?>" />
        </div>
        <div class="form-group col-md-6">
            <label>Preço: </label>
            <input type="text" class="form-control" placeholder="Insira o preço do livro" id="fEditarPreco"
                value="<?php echo $linha->Preco ?>" />
        </div>
        <div class="form-group">
            <label>Disponibilidade </label> <br>
            <input type="radio" name="disponibilidade" <?php if($linha->Disponibilidade == "Ativo") echo checked ?>
                id="fEditarDispAtivo" /> Ativo
            <br>
            <input type="radio" name="disponibilidade" <?php if($linha->Disponibilidade == "Inativo") echo checked ?>
                id="fEditarDispInativo" /> Inativo
        </div>
    </div>
</form>