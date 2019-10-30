<?php  

function cadastrarProduto($nomeProduto, $categProduto, $descProduto, $qtdeProduto, $precoProduto, $imgProduto){
    $nomeArquivo = "produto.json";
    if (file_exists($nomeArquivo)){
        $arquivo = file_get_contents($nomeArquivo);
        $produtos = json_decode($arquivo, true);
        $produtos[] = ["nome"=>$nomeProduto, "categ"=>$categProduto, "desc"=>$descProduto, "qtde"=>$qtdeProduto, "preco"=>$precoProduto, "img"=>$imgProduto];
        $json = json_encode($produtos);
        $sucesso = file_put_contents($nomeArquivo, $json);
        if($sucesso){
            return "Produto cadastrado com sucesso.";
        } else{
            return "Favor preencher corretamente todos os campos.";
        }   
        var_dump($produtos);
    }else{
        $produtos = [];
        $produtos[] = ["nome"=>$nomeProduto, "categ"=>$categProduto, "desc"=>$descProduto, "qtde"=>$qtdeProduto, "preco"=>$precoProduto, "img"=>$imgProduto];
        // validacao da ordem dos produtos na array acima
        // var_dump($produtos);
        
        $json = json_encode($produtos);
        // var_dump($json); - apenas validação se o código está funcionando até este ponto
        
        $sucesso = file_put_contents($nomeArquivo, $json);
        if($sucesso){
            return "Produto cadastrado com sucesso";
        } else{
            return "Favor preencher todos os campos corretamente.";
        }   
    }
}


if($_POST){
    // valida para verificar configuração de imagem e exit para parar a execução do PHP
    // var_dump($_FILES);
    // exit;

    $nomeImg = $_FILES["imgProduto"]["name"];
    $localTmp = $_FILES["imgProduto"]["tmp_name"];   
    $dataAtual = date("d-m-y");
    $caminhoSalvo = "img/".$dataAtual.$nomeImg;

    $sucesso = move_uploaded_file($localTmp, $caminhoSalvo);
    // exit;
    // echo cadastrarProduto($_POST["nomeProduto"], $_POST["descProduto"], $_POST["precoProduto"], $_POST["imgProduto"]);
   
    echo cadastrarProduto($_POST["nomeProduto"], $_POST["categProduto"], $_POST["descProduto"]. $_POST["qtdeProduto"], $_POST["precoProduto"], $caminhoSalvo);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="./css/style.css" rel=stylesheet>
    <title>Cadastrar produto</title>
</head>

<body>
    <!-- <?php include_once("header.php"); ?> -->
    <main class="container">
        <div class="row">
            <div class="col-6 mt-5">
                <h1>Todos os produtos</h1>
            </div>

            <div class="col-6 mt-5">
                <h2>Cadastrar Produto</h2>

                <div class="font-weight-bold">
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nomeProduto">Nome</label>
                            <input type="text" class="form-control" name="nomeProduto" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="categProduto">Categoria</label>
                            <select class="form-control" id="categProduto" name="categProduto">
                                <option selected>Selecione uma categoria</option>
                                <option value="surf">Surf</option>
                                <option value="standuppadle">Stand Up Paddle</option>
                                <option value="windsurf">Windsurf</option>
                                <option value="kitesurf">Kitesurf</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descProduto">Descrição</label>
                            <!-- <textarea class="form-control" name="descProduto" id="descProduto" placeholder="" > -->
                            <input type="text" class="form-control" name="descProduto" placeholder="" />
                        </div>

                        <div class="form-group">
                            <label for="qtdeProduto">Quantidade</label>
                            <input type="number" class="form-control" name="qtdeProduto" placeholder="" />
                        </div>
                    
                        <div class="form-group">
                            <label for="precoProduto">Preço</label>
                            <input type="number" class="form-control" name="precoProduto" placeholder="" />
                        </div>

                        <div class="form-group">
                            <label for="imgProduto">Foto do produto</label>
                            <input type="file" class="form-control-file" name="imgProduto" placeholder="" />
                        </div>

                        <button class="btn btn-success d-flex justify-content-flex-end">Enviar</button>

                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>