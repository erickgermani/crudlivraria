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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
    $(function() {
        //código para exibir os modais
    });
    </script>
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
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody id="linhas">
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="7"><center><button class="btn-crud" id="cadastrar">Cadastrar novo livro</button></center></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

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
</script>

</html>