<?php

// funcao que valida campo nomeProduto do cadastro - tentativa para que o cadastro não aceite nome e descrição apenas com espaços vazios - deu errado.
function validaNome($nomeProduto){
    global $erros;
    if(strlen($nomeProduto) == " "){
        array_push($erros, "Nome de produto inválido.");
    }
} 

function validaDescricao($descProduto){
    global $erros;
    if(strlen($descProduto) == " "){
        array_push($erros, "Descrição de produto inválida.");
    }
} 


?>