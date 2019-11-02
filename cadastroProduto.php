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
            return "";
        } else{
            return "Não foi possivel realizar o cadastro.";
        }   
    }else{
        $produtos = [];
        $produtos[] = ["nome"=>$nomeProduto, "categ"=>$categProduto, "desc"=>$descProduto, "qtde"=>$qtdeProduto, "preco"=>$precoProduto, "img"=>$imgProduto];
        
        $json = json_encode($produtos);
        $sucesso = file_put_contents($nomeArquivo, $json);
        if($sucesso){
            return "";
        } else{
            return "Não foi possivel realizar o cadastro.";
        }   
    }
}

if($_POST){
    $nomeImg = $_FILES["imgProduto"]["name"];
    $localTmp = $_FILES["imgProduto"]["tmp_name"];   
    $dataAtual = date("d-m-y_H_i_s_");
    $caminhoSalvo = "img/".$dataAtual.$nomeImg;
    $sucesso = move_uploaded_file($localTmp, $caminhoSalvo);
    echo cadastrarProduto($_POST["nomeProduto"], $_POST["categProduto"], $_POST["descProduto"], $_POST["qtdeProduto"], $_POST["precoProduto"], $caminhoSalvo);
}

?>


<!-- Pagina HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel=stylesheet>
    <title>Cadastrar produto</title>
</head>

<body>
    <?php include_once("variaveis.php"); ?>

    <main class="container">

<!-- Pagina HTML, coluna 01 -->
<section class="row">
        <div class="col-7">
            <div class="mt-5">
                <h1 class='pb-3'>Todos os produtos</h1>
            </div>

            <table class="table">
                <thead>
                    <tr class='tabela'>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Categoria</th>
                        <th scope='col'>Preço</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(isset($produtos) && $produtos != []) { ?>
                    <?php foreach($produtos as $produto){ ?>
                    <tr class='tabela'>
                        <td><a href='produto.php?nome=<?= $produto['nome']; ?>'><?= $produto['nome']; ?></td>
                        <td><?= $produto['categ']; ?></td>
                        <td><?= "R$".$produto['preco']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php }else{ ?>
            <h3>Não há produtos cadastrados no momento.</h3>
            <?php } ?>
        </div>


<!-- Pagina HTML, coluna 02 -->
                <div class="col-5">
        <div class="mt-5 ml-5 bg-light p-5">
            <h2 class='pb-3'>Cadastrar Produto</h2>

            <div class="font-weight-bold">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nomeProduto">Nome</label>
                        <input type="text" class="form-control" name="nomeProduto" id='nomeProduto' maxlenght=70 required />
                    </div>

                    <div class="form-group">
                        <label for="categProduto">Categoria</label>
                        <select class="form-control" id="categProduto" name="categProduto" required>
                            <option selected>Selecione uma categoria</option>
                            <option value="surf">Surf</option>
                            <option value="stand up padle">Stand Up Paddle</option>
                            <option value="windsurf">Windsurf</option>
                            <option value="kitesurf">Kitesurf</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descProduto">Descrição</label>
                        <textarea class="form-control noresize" name="descProduto" id="descProduto" placeholder=""  maxlenght=130 required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="qtdeProduto">Quantidade</label>
                        <input type="number" class="form-control" name="qtdeProduto" required />
                    </div>

                    <div class="form-group">
                        <label for="precoProduto">Preço</label>
                        <input type="number" class="form-control" name="precoProduto" required />
                    </div>

                    <div class="form-group">
                        <label for="imgProduto">Foto do produto</label>
                        <input type="file" class="form-control-file" name="imgProduto" placeholder="" required />
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
            </div>
            </div>
        </section>
    
    </main>

</body>

</html>