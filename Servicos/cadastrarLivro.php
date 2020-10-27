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
    $precoFormatado = formatarPreco($preco);

    $queryNome = mysql_query("SELECT * FROM Livro WHERE Nome like '".$nome."'") or die(mysql_error());

    if(mysql_num_rows($queryNome) == 0){
        $query = mysql_query("INSERT INTO Livro (Nome, Autor, QtdPaginas, Preco) VALUES ('".$nome."', '".$autor."', '".$qtdPaginas."', '".$precoFormatado."')") or die();
        $sucesso = "<div class='alert alert-success alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O livro foi inserido com sucesso no banco de dados.</div>";
        echo $sucesso;
        }
    else{
        $erro = "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Já existe um livro com este nome no banco de dados.</div>";
        echo $erro;
    }
?>