
<?php
session_start();
include 'connection.php';

if(isset($_COOKIE['carrinho']) && !empty($_COOKIE['carrinho'])) {
    $carrinho = json_decode($_COOKIE['carrinho'], true);

    foreach($carrinho as $produto) {
        $produto_id = $produto['id'];
        $quantidade = $produto['quantidade'];

        // Subtrair a quantidade do banco de dados
        $stmt = $con->prepare("UPDATE produtos SET quantidade = quantidade - :quantidade WHERE id = :id");
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindParam(':id', $produto_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Limpar o carrinho
    setcookie('carrinho', '', time() - 3600, '/');
}

header('Location: carrinho.php'); // Redirecionar de volta para o carrinho
exit();
?>
