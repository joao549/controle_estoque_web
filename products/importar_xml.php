<!DOCTYPE HTML>
<html>
<head>
    <title>Importar XML</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Importar XML</h1>
        </div>
        
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['xml_file'])) {
                $xml_file = $_FILES['xml_file']['tmp_name'];
                $xml = simplexml_load_file($xml_file);
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "senac";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                if($conn->connect_error){
                    die("Falha na conexão: ". $conn->connect_error);
                }
                $nome = $xml->Produtos->Nome;
                $descricao = $xml->Produtos->Descricao;
                $unidade = $xml->Produtos->Unidade;
                $valor = $xml->Produtos->Valor;
                $quantidade = $xml->Produtos->Quantidade;
                $imagem_base64 = (string) $xml->Produtos->Imagem;
                $imagem_data = base64_decode($imagem_base64);
                

                $sql = "INSERT INTO produtos (nome, descricao, unidade, valor, quantidade, imagem)
                VALUES ('$nome', '$descricao', '$unidade', $valor, $quantidade, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("b", $imagem_data); // "b" indica que estamos passando um blob (dados binários)
$stmt->send_long_data(0, $imagem_data);

if ($stmt->execute()) {
    echo "Dados inseridos com sucesso!";
} else {
    echo "Erro ao inserir dados: " . $conn->error;
}

$stmt->close();
$conn->close();
            
                echo "<div class='alert alert-success'>XML importado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Não bombou</div>";
            }
            ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="xml_file">Selecione o arquivo XML:</label>
                <input type="file" name="xml_file" id="xml_file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Importar</button>
            <a href="products.php" class="btn btn-danger">Voltar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
