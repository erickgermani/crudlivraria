<?php
    error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    require_once '../config.php';

    $con = conectar();
    mysql_select_db('livrariaonline') or die(mysql_error());

    $query = mysql_query("SELECT * FROM livro ORDER BY Nome");

    if(mysql_num_rows($query) == 0){
        echo "<td colspan='7'><center>Não existem livros cadastrados em nosso sistema.</center></td>";
    }

    while($linha=mysql_fetch_object($query)){
?>
    <tr>
    <td><?php echo $linha->Nome ?></td>
    <td><?php echo $linha->Autor ?></td>
    <td><?php echo $linha->QtdPaginas ?></td>
    <td><?php echo "R$ ", formatarPreco($linha->Preco) ?></td>
    <td><?php echo $linha->Disponibilidade ?>
    <button class="btn-crud" <?php if($linha->Disponibilidade == "Ativo"){ echo "style='margin-left: 11px'"; } ?> value="<?php echo $linha->Id?>" onclick="AlterarDisponibilidade(this.value)" title="Alterar disponibilidade"> Alterar </button>
    </td>
    <td><?php $DataDeCriacao = new DateTime($linha->DataDeCriacao); echo $DataDeCriacao->format('d-m-Y H:i:s') ?></td>
    <td><?php $DataDeEdicao = new DateTime($linha->DataDeEdicao); echo $DataDeEdicao->format('d-m-Y H:i:s') ?></td>
    <td>
    <center>
    <button class="btn-crud" value="<?php echo $linha->Id?>" data-toggle="modal" data-target="#modal-edicao" onclick="SelecionarLivro(this.value)">Editar</button>
    <button class="btn-crud" value="<?php echo $linha->Id?>" onclick="DeletarLivro(this.value)">Deletar</button>
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