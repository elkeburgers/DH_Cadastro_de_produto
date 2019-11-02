<?php  

// $nomeArquivo = __DIR__."produto.json";
$nomeArquivo = "produto.json";
$produtos = json_decode(file_get_contents($nomeArquivo), true);


$categorias=["Selecione uma categoria","Surf", "Stand Up Paddle","Windsurf", "Kitesurf"];

?>