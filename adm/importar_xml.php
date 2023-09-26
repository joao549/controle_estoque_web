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

    foreach($xml->Produtos as $produto){
        $nome = $produto->Nome;
        $descricao = $produto->Descricao;
        $unidade = $produto->Unidade;
        $valor = $produto->Valor;
        $quantidade = $produto->Quantidade;
        $imagem_base64 = (string) $produto->Imagem;
        $imagem_data = base64_decode($imagem_base64);

        $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, unidade, valor, quantidade, imagem) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdds", $nome, $descricao, $unidade, $valor, $quantidade, $imagem_data);

        if ($stmt->execute()) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();

    echo "<div class='alert alert-success'>XML importado com sucesso!</div>";
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
