<?php

$statement=$booksDB->getPDO()->prepare("
        SELECT 
            books.*, 
            users.email, 
            now() > last_update_started_at + INTERVAL 5 MINUTE AS edit_expired 
        FROM 
            books LEFT JOIN users ON 
                users.user_id = books.last_update_by 
        WHERE 
            books.book_code = :id
");
$statement->execute([
    'id' => $id
]);

$product = $statement->fetch();
if (!$product) {
    die('Produkt nenalezen!');
}
if(empty($_POST)){        
    if(isset($product['last_update_by']) && $product['last_update_by'] != $currentUser[0]['user_id'] && !$product['edit_expired']){
        header('Location: index.php?current_editor='.$product['email']);
        die();
    }
} 

?>