<!DOCTYPE HTML>
<html>
<head>
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .m-r-1em{ margin-right:1em; }
        .m-b-1em{ margin-bottom:1em; }
        .m-l-1em{ margin-left:1em; }
        .mt0{ margin-top:0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Seu Carrinho de Compras</h1>
        </div>
        <a href="products.php" class="btn btn-info m-b-1em">Voltar para Produtos</a>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
            </tr>
            <?php
                session_start();
                
                if(isset($_COOKIE['carrinho']) && !empty($_COOKIE['carrinho'])) {
                    foreach(json_decode($_COOKIE['carrinho']) as $produto) {
                        echo "<tr>
                                <td>{$produto->id}</td>
                                <td>{$produto->quantidade}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhum produto no carrinho</td></tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
