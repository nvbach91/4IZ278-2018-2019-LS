<?php

class ProductsDB {

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=zemp02;charset=utf8', 'zemp02', '|z+s_:(N,M?/{b=3$^');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function fetchAllUsers(){
        $sql=' Select * from users ORDER BY privilege DESC ';
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();;
        return $users;
    }

    function fetchUserByID($id){
        $sql ='SELECT * FROM users WHERE id = :id LIMIT 1';
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetchAll()[0];
        return $user;
    }

    function fetchUserByEmail($email){
        $sql ='SELECT * FROM users WHERE email = :email LIMIT 1';
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetchAll()[0];
        return $user;
    }

    function setUserPrivilege($id,$privilege){
        $sql='UPDATE users SET privilege = ? WHERE id = ?';
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(1,$privilege,PDO::PARAM_INT);
        $stmt->bindParam(2,$id,PDO::PARAM_INT);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    function fetchProduct($id){
        $sql ='SELECT * FROM goods WHERE id = :id';
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll();;
        return $products;
    }

    function fetchPage($page){
        $sql ='SELECT * FROM goods ORDER BY id DESC LIMIT 9 OFFSET :offset';
        $stmt= $this->db->prepare($sql);
        $page = $page*9;
        $stmt->bindParam(':offset',$page,PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll();;
        return $products;
    }

    function fetchAllProducts(){
        $sql=' Select * from goods';
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();;
        return $products;
    }

    function listSize(){
        $products= $this->fetchAllProducts();
        return count($products);

    }

    function numberOfPages(){
        return ceil($this->listSize()/9);
    }

    function getSpecifiedItems($ids){
        $question_marks = str_repeat('?,', count($ids) - 1) . '?';

        $stmt = $this->db->prepare("SELECT * FROM goods WHERE id IN ($question_marks) ORDER BY name");
        $stmt->execute(array_values($ids));
        $goods = $stmt->fetchAll();

        return $goods;

    }

    function getPrice($ids){
        $question_marks = str_repeat('?,', count($ids) - 1) . '?';

        $stmt_sum = $this->db->prepare("SELECT SUM(price) FROM goods WHERE id IN ($question_marks)");
        $stmt_sum->execute(array_values($ids));
        $sum = $stmt_sum->fetchColumn();

        return $sum;
    }

    function insertUser($email,$password){
        $stmt = $this->db->prepare("INSERT INTO users (email,password) VALUES (?, ?)");
        $stmt->bindParam(1,$email,PDO::PARAM_STR);
        $stmt->bindParam(2,$password,PDO::PARAM_STR);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    function insertGood($name,$description,$price){
        $stmt = $this->db->prepare("INSERT INTO goods (name, description, price) VALUES (?, ?, ?)");
        $stmt->bindParam(1,$name,PDO::PARAM_STR);
        $stmt->bindParam(2,$description,PDO::PARAM_STR);
        $stmt->bindParam(3,$price,PDO::PARAM_INT);
        $stmt->execute();
    }

    function updateGood($id,$name,$description,$price){
        $sql = "UPDATE goods SET name=?, description=?, price=? WHERE id=?";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([$name, $description, $price, $id]);
    }

    function deleteGood($id){
        $sql = "DELETE FROM goods WHERE id=?";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([$id]);
    }



}