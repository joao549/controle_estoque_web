<!DOCTYPE HTML>
<html>
<head>
    <title>Novo Produto</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    
    <div class="container">
        <div class="page-header">
            <h1>Inserção de Produto</h1>
        </div>
        <?php
if($_POST){
    
    include 'connection.php';
    try{
    
        $query = "INSERT INTO produtos SET nome=:nome, descricao=:descricao, unidade=:unidade, quantidade=:quantidade, valor=:valor, imagem=:imagem";
    
        $stmt = $con->prepare($query);
    
        $nome=htmlspecialchars(strip_tags($_POST['nome']));

        $descricao=htmlspecialchars(strip_tags($_POST['descricao']));

        $unidade=htmlspecialchars(strip_tags($_POST['unidade']));

        $quantidade=htmlspecialchars(strip_tags($_POST['quantidade']));

        $valor=htmlspecialchars(strip_tags($_POST['valor']));

        if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
            $stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
        }
    
        $stmt->bindParam(':nome', $nome);
        
        $stmt->bindParam(':descricao', $descricao);

        $stmt->bindParam(':unidade', $unidade);

        $stmt->bindParam(':quantidade', $quantidade);

        $stmt->bindParam(':valor', $valor);

        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
        
    
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
    }
    
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Nome</td>
            <td><input type='text' name='nome' class='form-control' /></td>
        </tr>
       
        <tr>
            <td>Descrição</td>
            <td><input type='text' name='descricao' class='form-control' /></td>
        </tr>

        <tr>
            <td>Unidade</td>
            <td>
            <select type='text' name='unidade'>
            <option value = 'UN'>UN</option>
            <option value = 'KG'>KG</option>
            </select>
            </td>
        </tr>

        <tr>
            <td>Quantidade</td>
            <td><input type='text' name='quantidade' class='form-control' /></td>
        </tr>

        <tr>
            <td>Valor</td>
            <td><input type='text' name='valor' class='form-control' /></td>
        </tr>

        <tr>
            <td>Imagem</td>
            <td><input type='file' name='imagem' class='form-control' /></td>
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
    </div> 

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

