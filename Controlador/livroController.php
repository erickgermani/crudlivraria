<?php
require_once '../Rotas/Roteador.php';
require_once '../Modelo/livro.php';
require_once '../Modelo/criadorDeTabela.php';
require_once '../Modelo/conexao.php';

$con = conectar();

$roteador = new Roteador();
$funcao = $_POST['funcao'];

$roteador
    ->add(1, 'index', $con)
    ->add(2, 'create', $con)
    ->add(3, 'find', $con)
    ->add(4, 'update', $con)
    ->add(5, 'destroy', $con)
    ->add(6, 'updateAvailability', $con)
    ->add(7, 'showById', $con)
    ->dispatch($funcao);

/**
 * 1
 */
function index($con)
{
    $livro = new Livro();
    $query = $livro->carregarLivros($con);
    CriadorDeTabela::criar($query);
}

/**
 * 2
 */
function create($con)
{
    $livro = new Livro();
    $livro->Nome = $_POST['nome'];
    $livro->Autor = $_POST['autor'];
    $livro->QtdPaginas = $_POST['qtdpaginas'];
    $livro->Preco = formatarPrecoParaBD($_POST['preco']);
    $livro->cadastrarLivro($con);
}

/**
 * 3
 */
function find($con)
{
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->selecionarLivro($con);
}

/**
 * 4
 */
function update($con)
{
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->Nome = $_POST['nome'];
    $livro->Autor = $_POST['autor'];
    $livro->QtdPaginas = $_POST['qtdpaginas'];
    $livro->Preco = formatarPrecoParaBD($_POST['preco']);
    $livro->Disponibilidade = $_POST['disponibilidade'];
    $livro->editarLivro($con);
}

/**
 * 5
 */
function destroy($con)
{
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->deletarLivro($con);
}

/**
 * 6
 */
function updateAvailability($con)
{
    $livro = new Livro();
    $livro->Id = $_POST['id'];
    $livro->alterarDisponibilidade($con);
}

/**
 * 7
 */
function showById($con)
{
    $livro = new Livro();
    $valor = $_POST['valor'];
    $query = $livro->pesquisarlivros($con, $valor);
    CriadorDeTabela::criar($query);
}