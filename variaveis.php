<?php  

// $nomeArquivo = _DIR_."produto.json";
$nomeArquivo = "produto.json";
$produtos = json_decode(file_get_contents($nomeArquivo), true);

?>