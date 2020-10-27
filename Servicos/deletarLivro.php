<?php
    error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    require_once '../config.php';
    require_once 'funcoes.php';
    $con = conectar();
    mysql_select_db('livrariaonline') or die(mysql_error());

    $id = $_POST['id'];

    $sqldelete = mysql_query("DELETE FROM Livro WHERE Id = '".$id."'") or die(mysql_error());
?>