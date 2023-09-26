<!DOCTYPE HTML>
<html>
<head>
    <title>Detalhes do Produto</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    
    <div class="container">
        <div class="page-header">
            <h1>Detalhes do Produto</h1>
        </div>
        <?php

$id=isset($_GET['id']) ? $_GET['id'] : die('ERRO: ID NÃO ENCONTRADO');

include 'connection.php';

try {

    $query = "SELECT id, nome, descricao, unidade, quantidade, valor, imagem FROM produtos WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );

    $stmt->bindParam(1, $id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $nome = $row['nome'];
    $descricao = $row['descricao'];
    $unidade = $row['unidade'];
    $quantidade = $row['quantidade'];
    $valor = $row['valor'];
    $imagem = $row['imagem'];
}

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>

<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Nome</td>
        <td><?php echo htmlspecialchars($nome, ENT_QUOTES);?></td>
    </tr>
   
    <tr>
        <td>Descrição</td>
        <td><?php echo htmlspecialchars($descricao, ENT_QUOTES);?></td>
    </tr>

    <tr>
        <td>Unidade</td>
        <td><?php echo htmlspecialchars($unidade, ENT_QUOTES);?></td>
    </tr>

    <tr>
        <td>Quantidade</td>
        <td><?php echo htmlspecialchars($quantidade, ENT_QUOTES);?></td>
    </tr>

    <tr>
        <td>Valor</td>
        <td><?php echo htmlspecialchars($valor, ENT_QUOTES);?></td>
    </tr>

    <tr>
    <td>Imagem</td>
    <td>
        <?php
       if ($imagem !== null) {
        echo '<img src="data:image/jpeg;base64,'.base64_encode($imagem).'" />';
    } else {
        echo 'Imagem não disponível';
    }
        ?>
    </td>
    </tr>

    
    <tr>
        <td></td>
        <td>
            <a href='products.php' class='btn btn-danger'>Voltar</a>
        </td>
    </tr>
</table>
    </div> 

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>