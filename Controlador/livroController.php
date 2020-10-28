<?php

require_once '../Modelo/livro.php';
require_once '../Modelo/criadorDeTabela.php';
require_once '../Modelo/conexao.php';

$con = conectar();
mysql_select_db('livrariaonline') or die(mysql_error());
$funcao = $_POST['funcao'];

if($funcao == 1){
    $livro = new Livro();
    $query = $livro->carregarLivros();
    CriadorDeTabela::criar($query);
}

if($funcao == 2){
    $livro = new Livro();
    $livro->Nome = $_POST['nome'];
    $livro->Autor = $_POST['autor'];
    $livro->QtdPaginas = $_POST['qtdPaginas'];
    $livro->Preco = formatarPrecoParaBD($_POST['preco']);
    $livro->cadastrarLivro();
}

if($funcao == 3){
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->selecionarLivro();
}

if($funcao == 4){
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->Nome = $_POST['nome'];
    $livro->Autor = $_POST['autor'];
    $livro->QtdPaginas = $_POST['qtdPaginas'];
    $livro->Preco = formatarPrecoParaBD($_POST['preco']);
    $livro->Disponibilidade = $_POST['disponibilidade'];
    $livro->editarLivro();
}

if($funcao == 5){
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->deletarLivro();
}

if($funcao == 6){
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->alterarDisponibilidade();
}

if($funcao == 7){
    $livro = new Livro();
    $valor = $_POST['valor'];
    $query = $livro->pesquisarLivros($valor);
    CriadorDeTabela::criar($query);
}

?>