<?php
    error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    require_once '../config.php';

    $con = conectar();
    mysql_select_db('livrariaonline') or die(mysql_error());

    $id = $_POST['id'];

    $query = mysql_query(" SELECT * FROM Livro WHERE Id = '".$id."' ") or die(mysql_error());
    $linha = mysql_fetch_object($query) or die(mysql_error());                                        
    
    if($linha->Disponibilidade == "Ativo"){
        $disponibilidade = "Inativo";  
    }
    else{
        $disponibilidade = "Ativo";
    }

    $sql = mysql_query(" UPDATE Livro SET Disponibilidade = '".$disponibilidade."', DataDeEdicao = CURRENT_TIMESTAMP WHERE Id = '".$id."' ") or die(mysql_error()); 
?>