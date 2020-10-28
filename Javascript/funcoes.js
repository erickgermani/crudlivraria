var id;

$(document).ready(function() {
    CarregarLivros();
});

// Carregar tabela com os livros após o loading da página

function CarregarLivros() {
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

// Verificar se os campos de cadastro estão preenchidos com o formato correto

function VerificarCadastro() {
    var nome = $("#fCadastrarNome").val();
    var autor = $("#fCadastrarAutor").val();
    var qtdPaginas = $("#fCadastrarQtdPaginas").val();
    var preco = $("#fCadastrarPreco").val();
    if (!VerificarCampos(nome, autor, qtdPaginas, preco)) {
        var alertaCampo =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Preencha todos os campos.</div>"
        $("#alertaCadastro").html(alertaCampo);
        return;
    }
    if (!VerificarPreco(preco) || preco < 0) {
        var alertaPreco =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O preço está em um formato incorreto. Deve ser um número maior do que 0.</div>"
        $("#alertaCadastro").html(alertaPreco);
        return;
    }
    if (!VerificarQtdPaginas(qtdPaginas)) {
        var alertaQtdPaginas =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O número de páginas deve ser um número inteiro maior do que 0.</div>"
        $("#alertaCadastro").html(alertaQtdPaginas);
        return;
    }
    
    CadastrarLivro(nome, autor, qtdPaginas, preco);
}

function CadastrarLivro(nome, autor, qtdPaginas, preco) {
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
            CarregarLivros();
            $("#fCadastrarNome").val("");
            $("#fCadastrarAutor").val("");
            $("#fCadastrarQtdPaginas").val("");
            $("#fCadastrarPreco").val("");
        }
    });
}

// Preencher o modal Edicao com os dados do livro selecionado

function SelecionarLivro(idRecebido) {
    id = idRecebido;
    var page = "Servicos/selecionarLivro.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            id: id
        },
        beforeSend: function() {},
        success: function(resultado) {
            $("#edicao").html(resultado);
            var fEditarQtdPaginas = document.querySelector("#fEditarQtdPaginas");
            
            fEditarQtdPaginas.addEventListener("keypress", function(e) {
                if (e.key === ",") {
                    e.preventDefault();
                }
                if (e.key === ".") {
                    e.preventDefault();
                }
            });
        }
    });
    
    
}

// Verificar se os campos de edição estão preenchidos corretamente

function VerificarEdicao() {
    var nome = $("#fEditarNome").val();
    var autor = $("#fEditarAutor").val();
    var qtdPaginas = $("#fEditarQtdPaginas").val();
    var preco = $("#fEditarPreco").val();
    var disponibilidade;
    
    if ($("#fEditarDispAtivo").prop("checked")) {
        disponibilidade = "Ativo";
    }
    if ($("#fEditarDispInativo").prop("checked")) {
        disponibilidade = "Inativo";
    }
    
    if (!VerificarCampos(nome, autor, qtdPaginas, preco)) {
        var alertaCampo =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Preencha todos os campos.</div>"
        $("#alertaEdicao").html(alertaCampo);
        return;
    }
    if (!VerificarPreco(preco) || preco < 0) {
        var alertaPreco =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O preço está em um formato incorreto. Deve ser um número positivo.</div>"
        $("#alertaEdicao").html(alertaPreco);
        return;
    }
    if (!VerificarQtdPaginas(qtdPaginas)) {
        var alertaQtdPaginas =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O número de páginas deve ser um número inteiro maior do que 0.</div>"
        $("#alertaEdicao").html(alertaQtdPaginas);
        return;
    }
    EditarLivro(nome, autor, qtdPaginas, preco, disponibilidade);
}

function EditarLivro(nome, autor, qtdPaginas, preco, disponibilidade) {
    var page = "Servicos/editarLivro.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            nome: nome,
            autor: autor,
            qtdPaginas: qtdPaginas,
            preco: preco,
            disponibilidade: disponibilidade,
            id: id
        },
        beforeSend: function() {},
        success: function(resultado) {
            $("#alertaEdicao").html(resultado);
            CarregarLivros();
        }
    });
}

function DeletarLivro(id) {
    var page = "Servicos/deletarLivro.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            id: id
        },
        beforeSend: function() {},
        success: function(resultado) {
            if (resultado != "") {
                alert("Ocorreu um erro inesperado durante a exclusão. Tente novamente.");
            }
            CarregarLivros();
        }
    });
}

function AlterarDisponibilidade(id){
    var page = "Servicos/alterarDisponibilidade.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            id: id
        },
        beforeSend: function() {},
        success: function() {
            CarregarLivros();
        }
    });
}

function Pesquisar(){
    var valor = $("#pesquisarLivro").val();
    var page = "Servicos/pesquisarLivros.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            valor: valor
        },
        beforeSend: function() {
        },
        success: function(resultado) {
            $("#linhas").html(resultado);
        }
    });
}

function VerificarCampos(nome, autor, qtdPaginas, preco) {
    if (nome == "" || autor == "" || qtdPaginas == "" || preco == "") {
        return false;
    }
    return true;
}

function VerificarPreco(preco) {
    preco = preco.replace(",", ".");
    return $.isNumeric(preco);
}

function VerificarQtdPaginas(qtdPaginas) {
    if ($.isNumeric(qtdPaginas)) {
        if (qtdPaginas > 0) {
            return true;
        }
    }
    return false;
}

const fCadastrarQtdPaginas = document.querySelector("#fCadastrarQtdPaginas");

fCadastrarQtdPaginas.addEventListener("keypress", function(e) {
    if (e.key === ",") {
        e.preventDefault();
    }
    if (e.key === ".") {
        e.preventDefault();
    }
});