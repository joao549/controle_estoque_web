<!DOCTYPE HTML>
<html>
<head>
    <title>Gerenciamento de Produtos</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Gerenciamento de Produtos</h1>
        </div>
        <?php
// include database connection
include 'connection.php';
$action = isset($_GET['action']) ? $_GET['action'] : "";
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
// select all data
$query = "SELECT id, nome, descricao, unidade, quantidade, valor, imagem FROM produtos ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();
$num = $stmt->rowCount();
echo "<a href='create.php' class='btn btn-primary m-b-1em'>NOVO PRODUTO</a>";

echo "<a class='btn btn-primary m-b-1em'>Gerar XML</a>";

if($num>0){

echo "<table class='table table-hover table-responsive table-bordered'>";

echo "<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Descrição</th>
    <th>Unidade</th>
    <th>Quantidade</th>
    <th>Valor</th>
    <th>Imagem</th>
    
    
    
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
        <td>{$imagem}</td>
        <td>";
            
            echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Detalhes</a>";
            
            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Editar</a>";
            
            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Excluir</a>";
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

function delete_user( id ){
    var answer = confirm('Tem Certeza?');
    if (answer){
       
        window.location = 'delete.php?id=' + id;
    }
}
</script>
</body>
</html>