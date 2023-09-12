<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform user authentication (e.g., check against a database).
    // You should hash and compare the password securely in a real application.

    // For this example, let's assume a hardcoded username and password.
    $valid_username = "admin";
    $valid_password = "admin";

    if ($username === $valid_username && $password === $valid_password) {
        // Authentication successful
        header("Location: ../products/products.php");
    } else {
        // Authentication failed
        echo "Senha ou usuário incorreto";
    }
}
?>
