<?php

class Livro {
    public $Id;
    public $Nome;
    public $Autor;
    public $QtdPaginas;
    public $Preco;
    public $Disponibilidade;
    
    function carregarLivros(){
        return $query = mysql_query("SELECT * FROM livro ORDER BY Nome");
    }
    
    function cadastrarLivro(){
        $query = mysql_query(" SELECT * FROM Livro WHERE Nome like '".$this->Nome."' ") or die(mysql_error());
        
        if(mysql_num_rows($query) == 0){
            $query = mysql_query("INSERT INTO Livro (Nome, Autor, QtdPaginas, Preco) VALUES ('".$this->Nome."', '".$this->Autor."', '".$this->QtdPaginas."', '".$this->Preco."')") or die(mysql_error());
            $sucesso = "<div class='alert alert-success alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O livro foi inserido com sucesso no banco de dados.</div>";
            echo $sucesso;
        }
        else{
            $erro = "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Já existe um livro com este nome no banco de dados.</div>";
            echo $erro;
        }
    }
    
    function selecionarLivro(){    
        $query = mysql_query("SELECT * FROM Livro WHERE Id = '".$this->Id."'") or die(mysql_error());
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
        value="<?php echo formatarPreco($linha->Preco) ?>" />
        </div>
        <div class="form-group">
        <label>Disponibilidade </label> <br>
        <input type="radio" name="disponibilidade" <?php if($linha->Disponibilidade) echo checked ?>
        id="fEditarDispAtivo" /> Ativo
        <br>
        <input type="radio" name="disponibilidade" <?php if(!$linha->Disponibilidade) echo checked ?>
        id="fEditarDispInativo" /> Inativo
        </div>
        </div>
        </form>
        
        <?php
    }
    
    function editarLivro(){
        $query = mysql_query("SELECT * FROM Livro WHERE Nome like '".$this->Nome."' AND Id != '".$this->Id."'") or die(mysql_error());
        if(mysql_num_rows($query) == 0){
            if($this->Disponibilidade){
                $disponibilidade = 1;
            }
            else{
                $disponibilidade = 0;
            }
            $query = mysql_query("UPDATE Livro 
            SET
            Nome = '".$this->Nome."', Autor = '".$this->Autor."', QtdPaginas = '".$this->QtdPaginas."', Preco = '".$this->Preco."', Disponibilidade = '".$disponibilidade."', DataDeEdicao = CURRENT_TIMESTAMP
            WHERE
            Id = '".$this->Id."'") or die(mysql_error());
            
            $sucesso = "<div class='alert alert-success alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O livro foi editado com sucesso.</div>";
            echo $sucesso;
        }
        else{
            $erro = "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Já existe um livro com este nome no banco de dados.</div>";
            echo $erro;
        }
    }
    
    function deletarLivro(){
        $query = mysql_query("DELETE FROM Livro WHERE Id = '".$this->Id."'") or die(mysql_error());
    }
    
    function alterarDisponibilidade(){
        $query = mysql_query(" SELECT * FROM Livro WHERE Id = '".$this->Id."' ") or die(mysql_error());
        $linha = mysql_fetch_object($query) or die(mysql_error());                                  
        if($linha->Disponibilidade){
            $disponibilidade = 0;  
        }
        else{
            $disponibilidade = 1;
        }
        $sql = mysql_query(" UPDATE Livro SET Disponibilidade = '".$disponibilidade."', DataDeEdicao = CURRENT_TIMESTAMP WHERE Id = '".$this->Id."' ") or die(mysql_error()); 
    }
    
    function pesquisarLivros($valor){
        return $query = mysql_query(" SELECT * FROM Livro WHERE Nome like '".$valor."%' OR Autor like '".$valor."%' ORDER BY Nome");
    }

}

function formatarPrecoParaBD($preco){
    $precoFormatado = number_format($preco, 2, '.', '.');
    return $precoFormatado;
}

function formatarPreco($preco){
    $precoFormatado = number_format($preco, 2, ',', '.');
    return $precoFormatado;
}

?>