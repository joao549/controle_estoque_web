<?php
session_start();

include 'connection.php';

$query='SELECT id, nome, quantidade, valor FROM produtos';
$stmt = $con->prepare($query);
$stmt->execute();
$num = $stmt->rowCount();

if(isset($_POST['id']) && isset($_POST['quantidade'] && isset($_POST['valor']))){
    $productId = $_POST['id'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];

    $produto = array(
        'id' => $productId,
        'nome' => 'Nome do Produto',
        'quantidade' => $quantidade,
        'valor' => $valor,
    );

    
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    array_push($_SESSION['carrinho'], $produto);

    header("Location: carrinho.php"); 
    exit();
} else {
    echo "Erro ao adicionar o produto ao carrinho. Verifique se os dados do formulário estão corretos.";
}
?>
