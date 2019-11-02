<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel='stylesheet' href='/css/style.css'>
    <title>Produto</title>
</head>

<body>

    <?php include_once('variaveis.php'); ?>

    <section class='container bg-light p-4 mt-5'>

        <button class='mb-3'><a class="text-dark" href='cadastroProduto.php'>&#8656; Voltar para a lista de produtos</a></button>
    
        <div class='row'>
            <?php if(isset($produtos)&& $produtos !=[]){ ?>
            <?php foreach($produtos as $produto){
                if($_GET['idProduto'] == $produto['idProduto']){
            ?>
    
            <div class='col-5 mt-3'>
                <img src="<?php echo $produto['img']; ?>" class='col-8 width=100% ml-5' alt="Imagem do produto">
            </div>
    
            <div class='col-7'>
                <div class="card-body">

                    <h1 class="ml-3"><?php echo $produto['nome'] ?></h1>

                    <h6 class="ml-3">Categoria</h6>
                    <p class="ml-3 lead"><?php echo $produto['categ'] ?></p>

                    <h6 class="ml-3">Descrição</h6>
                    <p class="ml-3 lead"><?php echo $produto['desc'] ?></p>

                    <div class='d-flex justify-content-between col-7'>
                        <div>
                            <p>Quantidade em estoque</p>
                            <p><?php echo $produto['qtde'] ?></p>
                        </div>
                        <div>
                            <p class=''>Preço</p>
                            <p class='font-weight-bold'><?php echo  "R$".$produto['preco'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php    
                }
            }
            }
            ?>
        </div>
    </section>

</body>

</html>