<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform user authentication (e.g., check against a database).
    // You should hash and compare the password securely in a real application.

    // For this example, let's assume a hardcoded username and password.
    $adm_username = "admin";
    $adm_password = "admin";
    $cliente_username = "cliente";
    $cliente_password = "cliente";

    if ($username === $adm_username && $password === $adm_password) {
        header("Location: ../adm/products.php");
    } 
    elseif ($username === $cliente_username && $password === $cliente_password ) {
        header("Location: ../cliente/products.php");
    }else {
        // Authentication failed
        echo "Senha ou usuário incorreto";
    }
}
?>
