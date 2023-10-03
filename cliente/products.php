<!DOCTYPE HTML>
<html>
<head>
    <title>Gerenciamento de Produtos</title>

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
            <h1>Gerenciamento de Produtos</h1>
        </div>
        <?php

include 'connection.php';
$action = isset($_GET['action']) ? $_GET['action'] : "";

$query = "SELECT id, nome, descricao, unidade, quantidade, valor, imagem FROM produtos ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();
$num = $stmt->rowCount();
echo "<a href='carrinho.php' class='btn btn-primary m-b-1em'>VER CARRINHO</a>";
echo " ";
echo "<a href='../index.html'class='btn btn-danger m-b-1em'>SAIR</a>";

if($num>0){

echo "<table class='table table-hover table-responsive table-bordered'>";

echo "<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Descrição</th>
    <th>Unidade</th>
    <th>Quantidade</th>
    <th>Valor</th>
</tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    
    extract($row);
    
    echo "<tr>
        <td>{$id}</td>
        <td>{$nome}</td>
        <td>{$descricao}</td>
        <td>{$unidade}</td>
        <td>{$quantidade}</td>
        <td>{$valor}</td>
        
        <td>";
            
            echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Detalhes</a>";
            echo "<a href='add_carrinho.php?id={$id}' class='btn btn-primary m-r-1em'>Adicionar ao Carrinho</a>";
        echo "</td>";
    echo "</tr>";
}

echo "</table>";
}

else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type='text/javascript'>
</script>
</body>
</html>