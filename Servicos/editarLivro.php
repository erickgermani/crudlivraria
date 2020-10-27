<?php
    error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    require_once '../config.php';
    require_once 'funcoes.php';
    $con = conectar();
    mysql_select_db('livrariaonline') or die(mysql_error());

    $nome = $_POST['nome'];
	$autor = $_POST['autor'];
	$qtdPaginas = $_POST['qtdPaginas'];
    $preco = $_POST['preco'];
    $disponibilidade = $_POST['disponibilidade'];
    $id = $_POST['id'];
    $precoFormatado = formatarPreco($preco);

    $queryNome = mysql_query("SELECT * FROM Livro WHERE Nome like '".$nome."' AND Id != '".$id."'") or die(mysql_error());

    if(mysql_num_rows($queryNome) == 0){
        $query = mysql_query("UPDATE Livro 
        SET
        Nome = '".$nome."', Autor = '".$autor."', QtdPaginas = '".$qtdPaginas."', Preco = '".$precoFormatado."', Disponibilidade = '".$disponibilidade."', DataDeEdicao = CURRENT_TIMESTAMP
        WHERE
        Id = '".$id."'") or die(mysql_error());

        $sucesso = "<div class='alert alert-success alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O livro foi editado com sucesso.</div>";
        echo $sucesso;
    }
    else{
        $erro = "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Já existe um livro com este nome no banco de dados.</div>";
        echo $erro;
    }
?>