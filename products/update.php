<!DOCTYPE HTML>
<html>
<head>
    <title>Editar Produto</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Alterar Produto</h1>
        </div>
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
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
    $unidade= $row['unidade'];
    $quantidade = $row['quantidade'];
    $valor = $row['valor'];
    $imagem = $row['imagem'];

}
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
        <?php
// check if form was submitted
if($_POST){
    try{
        // write update query
        // in this case, it seemed like we have so many fields to pass and
        // it is better to label them and not use question marks
        $query = "UPDATE produtos
                    SET nome=:nome, descricao=:descricao, unidade=:unidade, quantidade=:quantidade, valor=:valor, imagem=:imagem
                    WHERE id = :id";
        // prepare query for excecution
        $stmt = $con->prepare($query);
        // posted values
        $nome=htmlspecialchars(strip_tags($_POST['nome']));
        
        $descricao=htmlspecialchars(strip_tags($_POST['descricao']));
        $unidade=htmlspecialchars(strip_tags($_POST['unidade']));
        $quantidade=htmlspecialchars(strip_tags($_POST['quantidade']));
        $valor=htmlspecialchars(strip_tags($_POST['valor']));
        $imagem=htmlspecialchars(strip_tags($_POST['imagem']));

        // bind the parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':unidade', $unidade);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':imagem', $imagem);
        
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
    }
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Nome</td>
            <td><input type='text' name='name' value="<?php echo htmlspecialchars($nome, ENT_QUOTES);  ?>" class='form-control'/></td>
        </tr>
        
        <tr>
            <td>Descrição</td>
            <td><input type='text' name='price' value="<?php echo htmlspecialchars($descricao, ENT_QUOTES);  ?>" class='form-control'/></td>
        </tr>

        <tr>
            <td>Unidade</td>
            <td><input type='text' name='price' value="<?php echo htmlspecialchars($unidade, ENT_QUOTES);  ?>" class='form-control'/></td>
        </tr>

        <tr>
            <td>Quantidade</td>
            <td><input type='text' name='price' value="<?php echo htmlspecialchars($quantidade, ENT_QUOTES);  ?>" class='form-control'/></td>
        </tr>

        <tr>
            <td>Valor</td>
            <td><input type='text' name='price' value="<?php echo htmlspecialchars($valor, ENT_QUOTES);  ?>" class='form-control'/></td>
        </tr>

        <tr>
            <td>Imagem</td>
            <td><input type='text' name='price' value="<?php echo htmlspecialchars($imagem, ENT_QUOTES);  ?>" class='form-control'/></td>
        </tr>

       

        <tr>
            <td></td>
            <td>
                <input type='submit' value='Gravar Alteracoes' class='btn btn-primary' />
                <a href='products.php' class='btn btn-danger'>Voltar</a>
            </td>
        </tr>
    </table>
</form>
    </div> <!-- end .container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>