<?php

$statement=$goodsDB->getPDO()->prepare("
        SELECT 
            goods.*, 
            users.email, 
            now() > last_update_started_at + INTERVAL 5 MINUTE AS edit_expired 
        FROM 
            goods LEFT JOIN users ON 
                users.id = goods.last_update_by 
        WHERE 
            goods.id = :id
    ");
    $statement->execute([
        'id' => $id
    ]);

    $product = $statement->fetch();
    if (!$product) {
        die('Unable to find product!');
    }
    if(empty($_POST)){        
        if(isset($product['last_update_by']) && $product['last_update_by'] != $current_user[0]['id'] && !$product['edit_expired']){
            header('Location: index.php?current_editor='.$product['email']);
            die();
        }
    } 

?>