<?php

function filterItensByLojaId(array $itens, $lojaId)
{
    return array_filter($itens, function ($linha) use ($lojaId){
        return $linha['loja_id'] == $lojaId;
    });
}
