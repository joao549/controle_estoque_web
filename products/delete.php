<?php

include 'connection.php';
try {
    
    
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    
    $query = "DELETE FROM produtos WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
    if($stmt->execute()){
    
        header('Location: products.php?action=deleted');
    }else{
        die('Não foi possível excluir o produto.');
    }
}

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>