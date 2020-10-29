<?php

require_once '../Modelo/livro.php';
require_once '../Modelo/criadorDeTabela.php';
require_once '../Modelo/conexao.php';

$con = conectar();
mysqli_select_db($con, 'livrariaonline') or die(mysqli_error());
$funcao = $_POST['funcao'];

if($funcao == 1){
    $livro = new Livro();
    $query = $livro->carregarLivros($con);
    CriadorDeTabela::criar($query);
}

if($funcao == 2){
    $livro = new Livro();
    $livro->Nome = $_POST['nome'];
    $livro->Autor = $_POST['autor'];
    $livro->qtdpaginas = $_POST['qtdpaginas'];
    $livro->Preco = formatarPrecoParaBD($_POST['preco']);
    $livro->cadastrarLivro($con);
}

if($funcao == 3){
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->selecionarLivro($con);
}

if($funcao == 4){
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->Nome = $_POST['nome'];
    $livro->Autor = $_POST['autor'];
    $livro->qtdpaginas = $_POST['qtdpaginas'];
    $livro->Preco = formatarPrecoParaBD($_POST['preco']);
    $livro->Disponibilidade = $_POST['disponibilidade'];
    $livro->editarLivro($con);
}

if($funcao == 5){
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->deletarLivro($con);
}

if($funcao == 6){
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->alterarDisponibilidade($con);
}

if($funcao == 7){
    $livro = new Livro();
    $valor = $_POST['valor'];
    $query = $livro->pesquisarlivros($con, $valor);
    CriadorDeTabela::criar($query);
}

?>