<?php
class Livro {
    public $Id;
    public $Nome;
    public $Autor;
    public $QtdPaginas;
    public $Preco;
    public $Disponibilidade;
    
    function carregarLivros($con){
        return mysqli_query($con, "SELECT * FROM livro ORDER BY Nome");
    }
    
    function cadastrarLivro($con){
        $query = mysqli_query($con, " SELECT * FROM Livro WHERE Nome like '".$this->Nome."' ") or die(mysqli_error());
        
        if(mysqli_num_rows($query) == 0){
            $query = mysqli_query($con, "INSERT INTO Livro (Nome, Autor, QtdPaginas, Preco) VALUES ('".$this->Nome."', '".$this->Autor."', '".$this->QtdPaginas."', '".$this->Preco."')") or die(mysqli_error());
            $sucesso = "<div class='alert alert-success alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O livro foi inserido com sucesso no banco de dados.</div>";
            echo $sucesso;
        }
        else{
            $erro = "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Já existe um livro com este nome no banco de dados.</div>";
            echo $erro;
        }
    }
    
    function selecionarLivro($con){    
        $query = mysqli_query($con, "SELECT * FROM Livro WHERE Id = '".$this->Id."'") or die(mysqli_error());
        $linha = mysqli_fetch_object($query);
        
        ?>
        
        <form>
        <label>Nome: </label>
        <input type="text" class="form-control" placeholder="Insira o nome do livro" id="feditarnome"
        value="<?php echo $linha->Nome ?>" /> <br>
        <label>Autor: </label>
        <input type="text" class="form-control" placeholder="Insira o autor do livro" id="feditarautor"
        value="<?php echo $linha->Autor ?>" />
        <br>
        <div class="form-row">
        <div class="form-group col-md-6">
        <label>Quantidade de Páginas: </label>
        <input type="text" class="form-control" placeholder="Insira a quantidade de páginas do livro"
        id="feditarqtdpaginas" value="<?php echo $linha->QtdPaginas ?>" />
        </div>
        <div class="form-group col-md-6">
        <label>Preço: </label>
        <input type="text" class="form-control" placeholder="Insira o preço do livro" id="feditarpreco"
        value="<?php echo formatarPrecoParaModal($linha->Preco) ?>" />
        </div>
        <div class="form-group">
        <label>Disponibilidade </label> <br>
        <input type="radio" name="disponibilidade" <?php if($linha->Disponibilidade){ echo "checked"; }?>
        id="feditardispativo" /> Ativo
        <br>
        <input type="radio" name="disponibilidade" <?php if(!$linha->Disponibilidade){ echo "checked"; }?>
        id="feditardispinativo" /> Inativo
        </div>
        </div>
        </form>
        
        <?php
    }
    
    function editarLivro($con){
        $query = mysqli_query($con, "SELECT * FROM Livro WHERE Nome like '".$this->Nome."' AND Id != '".$this->Id."'") or die(mysqli_error());
        if(mysqli_num_rows($query) == 0){
            if($this->Disponibilidade){
                $disponibilidade = 1;
            }
            else{
                $disponibilidade = 0;
            }
            $query = mysqli_query($con, "UPDATE Livro 
            SET
            Nome = '".$this->Nome."', Autor = '".$this->Autor."', QtdPaginas = '".$this->QtdPaginas."', Preco = '".$this->Preco."', Disponibilidade = '".$disponibilidade."', DataDeEdicao = CURRENT_TIMESTAMP
            WHERE
            Id = '".$this->Id."'") or die(mysqli_error());
            
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>O livro foi editado com sucesso.</div>";
        }
        else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert' style='cursor: pointer'>Já existe um livro com este nome no banco de dados.</div>";
        }
    }
    
    function deletarLivro($con){
        mysqli_query($con, "DELETE FROM Livro WHERE Id = '".$this->Id."'") or die(mysqli_error());
    }
    
    function alterarDisponibilidade($con){
        $query = mysqli_query($con, " SELECT * FROM Livro WHERE Id = '".$this->Id."' ") or die(mysqli_error());
        $linha = mysqli_fetch_object($query) or die(mysqli_error());                                  
        if($linha->Disponibilidade){
            $disponibilidade = 0;  
        }
        else{
            $disponibilidade = 1;
        }
        $sql = mysqli_query($con, " UPDATE Livro SET Disponibilidade = '".$disponibilidade."', DataDeEdicao = CURRENT_TIMESTAMP WHERE Id = '".$this->Id."' ") or die(mysqli_error()); 
    }
    
    function pesquisarlivros($con, $valor){
        return mysqli_query($con, "SELECT * FROM Livro WHERE Nome like '".$valor."%' OR Autor like '".$valor."%' ORDER BY Nome");
    }

}

function formatarPrecoParaBD($preco){
    $preco = str_replace(",", ".", $preco);
    $preco = number_format($preco, 2, '.', '');
    return $preco;
}

function formatarPrecoParaTabela($preco){
    $preco = number_format($preco, 2, ',', '.');
    return $preco;
}

function formatarPrecoParaModal($preco){
    $preco = number_format($preco, 2, ',', '');
    return $preco;
}

?>