<!DOCTYPE HTML>
<html>
<head>
    <title>Novo Produto</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Inserção de Produto</h1>
        </div>
        <?php
if($_POST){
    // include database connection
    include 'connection.php';
    try{
        // insert query
        $query = "INSERT INTO products SET name=:name, price=:price";
        // prepare query for execution
        $stmt = $con->prepare($query);
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        
        $price=htmlspecialchars(strip_tags($_POST['price']));
        // bind the parameters
        $stmt->bindParam(':name', $name);
        
        $stmt->bindParam(':price', $price);
        // specify when this record was inserted to the database
        
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
    }
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Nome</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
       
        <tr>
            <td>Preço</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Gravar' class='btn btn-primary' />
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