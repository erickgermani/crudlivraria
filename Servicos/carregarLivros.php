<?php
    error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    require_once '../config.php';

    $con = conectar();
    mysql_select_db('livrariaonline') or die(mysql_error());

    $consulta = mysql_query("SELECT * FROM livro");

    if(mysql_num_rows($consulta) == 0){
        echo "<td colspan='7'><center>Não existem livros cadastrados em nosso sistema.</center></td>";
    }

    while($linha=mysql_fetch_object($consulta)){
?>
<tr>
    <td><?php echo $linha->Nome ?></td>
    <td><?php echo $linha->Autor ?></td>
    <td><?php echo $linha->QtdPaginas ?></td>
    <td><?php echo "R$ ", formatarPreco($linha->Preco) ?></td>
    <td><?php echo $linha->Disponibilidade ?></td>
    <td><?php echo $linha->DataDeEdicao ?></td>
    <td>
        <center>
            <button class="btn-crud" id="editar<?php echo $linha->Id?>">Editar</button>
            <button class="btn-crud" id="deletar<?php echo $linha->Id?>">Deletar</button>
        </center>
    </td>
</tr>
<?php
    }

    function formatarPreco($preco){
        $precoFormatado = number_format($preco, 2, ',', '.');
        return $precoFormatado;
    }
?>