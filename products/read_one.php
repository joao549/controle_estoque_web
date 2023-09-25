<!DOCTYPE HTML>
<html>
<head>
    <title>Detalhes do Produto</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Detalhes do Produto</h1>
        </div>
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERRO: ID NÃO ENCONTRADO');
//include database connection
include 'connection.php';
// read current record's data
try {
    // prepare select query
    $query = "SELECT id, nome, descricao, unidade, quantidade, valor, imagem FROM produtos WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
    // this is the first question mark
    $stmt->bindParam(1, $id);
    // execute our query
    $stmt->execute();
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // values to fill up our form
    $nome = $row['nome'];
    $descricao = $row['descricao'];
    $unidade = $row['unidade'];
    $quantidade = $row['quantidade'];
    $valor = $row['valor'];
    $imagem = $row['imagem'];
}
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
        <!--we have our html table here where the record will be displayed-->
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
        var_dump($imagem);
        if ($imagem !== null) {
            $caminhoDaImagem = 'imagens/' . $imagem;
            if (file_exists($caminhoDaImagem)) {
                echo '<img src="'.$caminhoDaImagem.'" />';
            } else {
                echo 'Imagem não encontrada';
            }
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
    </div> <!-- end .container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>