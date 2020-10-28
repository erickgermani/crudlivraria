<?php

class criadorDeTabela{
    static function criar($query){
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
            <td><?php if($linha->Disponibilidade){echo "Ativo";} else{echo "Inativo";}?>
            <button class="btn-crud" <?php if($linha->Disponibilidade == true){ echo "style='margin-left: 11px'"; } ?> value="<?php echo $linha->Id?>" onclick="AlterarDisponibilidade(this.value)" title="Alterar disponibilidade"> Alterar </button>
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
    }
}

?>