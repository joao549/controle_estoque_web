<?php
// used to connect to the database
$host = "localhost";
$db_name = "id21240498_projeto";
$username = "id21240498_delirebeca174";
$password = "Senac@2023";
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>