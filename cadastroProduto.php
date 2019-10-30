<?php  

function cadastrarProduto($nomeProduto, $categProduto, $descProduto, $qtdeProduto, $precoProduto, $imgProduto){
    $nomeArquivo = "produto.json";
    if (file_exists($nomeArquivo)){
        $arquivo = file_get_contents($nomeArquivo);
        $produtos = json_decode($arquivo, true);
        $produtos[] = ["nome"=>$nomeProduto, "categ"=>$categProduto, "desc"=>$descProduto, "qtde"=>$qtdeProduto, "preco"=>$precoProduto, "img"=>$imgProduto];
        $json = json_encode($produtos);
        $sucesso = file_put_contents($nomeArquivo, $json);
    }else{
        $produtos = [];
        $produtos[] = ["nome"=>$nomeProduto, "categ"=>$categProduto, "desc"=>$descProduto, "qtde"=>$qtdeProduto, "preco"=>$precoProduto, "img"=>$imgProduto];
        
        $json = json_encode($produtos);
        
        $sucesso = file_put_contents($nomeArquivo, $json);
        if($sucesso){
            return "Produto cadastrado com sucesso";
        } else{
            return "Favor preencher todos os campos corretamente.";
        }   
    }
}

if($_POST){
    $nomeImg = $_FILES["imgProduto"]["name"];
    $localTmp = $_FILES["imgProduto"]["tmp_name"];   
    $dataAtual = date("d-m-y");
    $caminhoSalvo = "img/".$dataAtual.$nomeImg;
    $sucesso = move_uploaded_file($localTmp, $caminhoSalvo);
    echo cadastrarProduto($_POST["nomeProduto"], $_POST["categProduto"], $_POST["descProduto"], $_POST["qtdeProduto"], $_POST["precoProduto"], $caminhoSalvo);
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
    <?php include_once("variaveis.php"); ?>

    <main class="container">

        <div class="row">
            <div class="col-7 mt-5">
                <h1>Todos os produtos</h1>
            </div>

            <?php if(isset($produtos) && $produtos != []) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Categoria</th>
                        <th scope='col'>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtos as $produto){ ?>
                    <tr>
                        <td></td>
                        <td><?= $produto['nome']; ?></td>
                        <td><?= $produto['categoria']; ?></td>
                        <td><?= "R$ ".$produto['preco']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php }else{
                echo "<h3>Não há produtos disponíveis no momento.</h3>";
            }
            ?>


            <div class="col-5 mt-5">
                <h2>Cadastrar Produto</h2>

                <div class="font-weight-bold">
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nomeProduto">Nome</label>
                            <input type="text" class="form-control" name="nomeProduto" />
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
                            <textarea class="form-control noresize" name="descProduto" id="descProduto"
                                placeholder=""></textarea>
                            <!-- <input type="text" class="form-control " name="descProduto"/> -->
                        </div>

                        <div class="form-group">
                            <label for="qtdeProduto">Quantidade</label>
                            <input type="number" class="form-control" name="qtdeProduto" />
                        </div>

                        <div class="form-group">
                            <label for="precoProduto">Preço</label>
                            <input type="number" class="form-control" name="precoProduto" />
                        </div>

                        <div class="form-group">
                            <label for="imgProduto">Foto do produto</label>
                            <input type="file" class="form-control-file" name="imgProduto" placeholder="" />
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>