<?php

// funcao que valida campo nomeProduto do cadastro - pensar como fazer
function validaNome($nomeProduto){
    global $erros;
    if(strlen($nomeProduto) == 0){
        array_push($erros, "Nome de produto já cadastrado.");
    }
} 



?>