var id;

$(document).ready(function() {
    carregarLivros();
});

// Carregar tabela com os livros após o loading da página

function carregarLivros() {
    var funcao = 1;
    var page = "Controlador/livroController.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            funcao: funcao
        },
        beforeSend: function() {},
        success: function(resultado) {
            $("#linhas").html(resultado);
        }
    });
}

// Verificar se os campos de cadastro estão preenchidos com o formato correto

function verificarCadastro() {
    var nome = $("#fcadastrarnome").val();
    var autor = $("#fcadastrarautor").val();
    var qtdpaginas = $("#fcadastrarqtdpaginas").val();
    var preco = $("#fcadastrarpreco").val();
    if (!verificarCampos(nome, autor, qtdpaginas, preco)) {
        var alertacampo =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Preencha todos os campos.</div>"
        $("#alertacadastro").html(alertacampo);
        return;
    }
    if (!verificarPreco(preco) || preco < 0) {
        var alertapreco =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O preço está em um formato incorreto. Deve ser um número maior do que 0.</div>"
        $("#alertacadastro").html(alertapreco);
        return;
    }
    if (!verificarqtdpaginas(qtdpaginas)) {
        var alertaqtdpaginas =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O número de páginas deve ser um número inteiro maior do que 0.</div>"
        $("#alertacadastro").html(alertaqtdpaginas);
        return;
    }
    
    CadastrarLivro(nome, autor, qtdpaginas, preco);
}

function CadastrarLivro(nome, autor, qtdpaginas, preco) {
    var funcao = 2;
    var page = "Controlador/livroController.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            nome: nome,
            autor: autor,
            qtdpaginas: qtdpaginas,
            preco: preco,
            funcao: funcao
        },
        beforeSend: function() {},
        success: function(resultado) {
            $("#alertacadastro").html(resultado);
            carregarLivros();
            $("#fcadastrarnome").val("");
            $("#fcadastrarautor").val("");
            $("#fcadastrarqtdpaginas").val("");
            $("#fcadastrarpreco").val("");
        }
    });
}

// Preencher o modal Edicao com os dados do livro selecionado

function SelecionarLivro(idRecebido) {
    var funcao = 3;
    id = idRecebido;
    var page = "Controlador/livroController.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            funcao: funcao,
            id: id
        },
        beforeSend: function() {},
        success: function(resultado) {
            $("#edicao").html(resultado);
            var feditarqtdpaginas = document.querySelector("#feditarqtdpaginas");
            
            feditarqtdpaginas.addEventListener("keypress", function(e) {
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

function verificarEdicao() {
    var nome = $("#feditarnome").val();
    var autor = $("#feditarautor").val();
    var qtdpaginas = $("#feditarqtdpaginas").val();
    var preco = $("#feditarpreco").val();
    var disponibilidade;
    
    if ($("#feditardispativo").prop("checked")) {
        disponibilidade = 1;
    }
    if ($("#feditardispinativo").prop("checked")) {
        disponibilidade = 0;
    }
    
    if (!verificarCampos(nome, autor, qtdpaginas, preco)) {
        var alertacampo =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Preencha todos os campos.</div>"
        $("#alertaedicao").html(alertacampo);
        return;
    }
    if (!verificarPreco(preco) || preco < 0) {
        var alertapreco =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O preço está em um formato incorreto. Deve ser um número positivo.</div>"
        $("#alertaedicao").html(alertapreco);
        return;
    }
    if (!verificarqtdpaginas(qtdpaginas)) {
        var alertaqtdpaginas =
        "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O número de páginas deve ser um número inteiro maior do que 0.</div>"
        $("#alertaedicao").html(alertaqtdpaginas);
        return;
    }
    EditarLivro(nome, autor, qtdpaginas, preco, disponibilidade);
}

function EditarLivro(nome, autor, qtdpaginas, preco, disponibilidade) {
    var funcao = 4;
    var page = "Controlador/livroController.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            nome: nome,
            autor: autor,
            qtdpaginas: qtdpaginas,
            preco: preco,
            disponibilidade: disponibilidade,
            id: id,
            funcao: funcao
        },
        beforeSend: function() {},
        success: function(resultado) {
            $("#alertaedicao").html(resultado);
            carregarLivros();
        }
    });
}

function DeletarLivro(id) {
    var funcao = 5;
    var page = "Controlador/livroController.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            id: id,
            funcao: funcao
        },
        beforeSend: function() {},
        success: function(resultado) {
            if (resultado != "") {
                alert("Ocorreu um erro inesperado durante a exclusão. Tente novamente.");
            }
            carregarLivros();
        }
    });
}

function AlterarDisponibilidade(id){
    var funcao = 6;
    var page = "Controlador/livroController.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            id: id,
            funcao: funcao
        },
        beforeSend: function() {},
        success: function() {
            carregarLivros();
        }
    });
}

function pesquisar(){
    var funcao = 7;
    var valor = $("#pesquisarlivro").val();
    var page = "Controlador/livroController.php";
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        data: {
            valor: valor,
            funcao: funcao
        },
        beforeSend: function() {
        },
        success: function(resultado) {
            $("#linhas").html(resultado);
        }
    });
}

function verificarCampos(nome, autor, qtdpaginas, preco) {
    if (nome == "" || autor == "" || qtdpaginas == "" || preco == "") {
        return false;
    }
    return true;
}

function verificarPreco(preco) {
    preco = preco.replace(",", ".");
    if(preco > 0){
        return $.isNumeric(preco);
    }
}

function verificarqtdpaginas(qtdpaginas) {
    if ($.isNumeric(qtdpaginas)) {
        if (qtdpaginas > 0) {
            return true;
        }
    }
    return false;
}

const fcadastrarqtdpaginas = document.querySelector("#fcadastrarqtdpaginas");

fcadastrarqtdpaginas.addEventListener("keypress", function(e) {
    if (e.key === ",") {
        e.preventDefault();
    }
    if (e.key === ".") {
        e.preventDefault();
    }
});