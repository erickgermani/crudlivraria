<?php
function formatarPreco($preco){
    $precoFormatado = number_format($preco, 2, '.', '');
    return $precoFormatado;
}
?>