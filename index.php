<html>

<head>
    <title>
        Livraria Online
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="Estilos/nova-crud.css">
</head>

<body>
    <?php
            error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
            require_once 'config.php';
    ?>

    <!-- Barra de navegação -->
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Livraria Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
        </nav>
    </div>
    <br>

    <!-- Modais -->
    <div class="modal fade" id="modal-cadastro">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastro</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome: </label>
                        <input type="email" class="form-control" placeholder="Insira o nome do livro" id="nome" /> <br>
                        <label>Autor: </label>
                        <input type="email" class="form-control" placeholder="Insira o autor do livro" id="autor" />
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Quantidade de Páginas: </label>
                                <input type="email" class="form-control"
                                    placeholder="Insira a quantidade de páginas do livro" id="qtdPaginas" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Preço: </label>
                                <input type="email" class="form-control" placeholder="Insira o preço do livro"
                                    id="preco" />
                            </div>
                        </div>
                    </div>
                    <div id="alertaCadastro"> </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="margin-right: auto"
                        onclick="verificarCadastro()">Cadastrar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="tabela-livros">
        <div class="container-md">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Páginas</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Disponibilidade</th>
                        <th scope="col">Atualizado em</th>
                        <th scope="col">
                            <center>Ação</center>
                        </th>
                    </tr>
                </thead>
                <tbody id="linhas">
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="7">
                            <center><button class="btn-crud" data-toggle="modal" data-target="#modal-cadastro">Cadastrar
                                    livro</button></center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    carregarLivros();
});

function carregarLivros() {
    var page = "Servicos/carregarLivros.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {},
        beforeSend: function() {},
        success: function(resultado) {
            $("#linhas").html(resultado);
        }
    });
}

function verificarCadastro() {
    var nome = $("#nome").val();
    var autor = $("#autor").val();
    var qtdPaginas = $("#qtdPaginas").val();
    var preco = $("#preco").val();
    if (!verificarCampos(nome, autor, qtdPaginas, preco)) {
        var alertaCampo =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Preencha todos os campos.</div>"
        $("#alertaCadastro").html(alertaCampo);
        return;
    }
    if (!verificarPreco(preco) || preco < 0) {
        var alertaPreco =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O preço está em um formato incorreto. Deve ser um número positivo.</div>"
        $("#alertaCadastro").html(alertaPreco);
        return;
    }
    if (!verificarQtdPaginas(qtdPaginas)) {
        var alertaQtdPaginas =
            "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O número de páginas deve ser um número inteiro maior do que 0.</div>"
        $("#alertaCadastro").html(alertaQtdPaginas);
        return;
    }

    var page = "Servicos/cadastrarLivro.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            nome: nome,
            autor: autor,
            qtdPaginas: qtdPaginas,
            preco: preco
        },
        beforeSend: function() {},
        success: function(resultado) {
            $("#alertaCadastro").html(resultado);
            carregarLivros();
        }
    });
}

function verificarCampos(nome, autor, qtdPaginas, preco) {
    if (nome == "") {
        return false;
    }
    if (autor == "") {
        return false;
    }
    if (qtdPaginas == "") {
        return false;
    }
    if (preco == "") {
        return false;
    }
    return true;
}

function verificarPreco(preco) {
    preco = preco.replace(",", ".");
    return $.isNumeric(preco);
}

function verificarQtdPaginas(qtdPaginas) {
    if ($.isNumeric(qtdPaginas)) {
        if (qtdPaginas > 0) {
            return true;
        }
    }
    return false;
}

const qtdPaginas = document.querySelector("#qtdPaginas");
qtdPaginas.addEventListener("keypress", function(e) {
    if (e.key === ",") {
        e.preventDefault();
    }
    if (e.key === ".") {
        e.preventDefault();
    }
});
</script>

</html>