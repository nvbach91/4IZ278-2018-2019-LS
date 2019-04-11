<?php

 class ProductsDB {

     private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=zemp02;charset=utf8', 'zemp02', '|z+s_:(N,M?/{b=3$^');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function insertTableProduct(){
        $sql = ' INSERT INTO `products` (`name`, `price`, `img`) VALUES
 (\'Stop, Friendly Fire!\', \'100\', \'https://cdn.novelupdates.com/images/2018/09/sff.jpg\'),
 (\'Talisman Emperor\', \'100\', \'https://cdn.novelupdates.com/images/2015/09/tailsmanemperor.jpg\'),
 (\'City of Sin\', \'100\', \'https://cdn.novelupdates.com/images/2015/11/sincity.jpg\'),
 (\'Lord of All Reals\', \'100\', \'https://cdn.novelupdates.com/images/2016/06/King-of-Myriad-Domain-1.jpg\'),
 (\'The Charm of Soul Pets\', \'100\', \'https://cdn.novelupdates.com/images/2016/08/The-Charm-of-Soul-Pets-1.jpg\'),
 (\'Against the Gods\', \'100\', \'https://cdn.novelupdates.com/images/2016/06/1416425191645.jpg\');        
        ';


        $stmt= $this->db->prepare($sql);
        $stmt->execute();
    }

     function insertTableSlider(){
         $sql = ' INSERT INTO `slides` (`img`, `title`) VALUES
 (\'https://webbanner.webnovel.com/0_banner_1553599143_9700.jpg\', \'this\'),
 (\'https://ps.w.org/slider-wd/assets/screenshot-1.jpg?rev=1265847\', \'that\')  ';


         $stmt= $this->db->prepare($sql);
         $stmt->execute();
     }

     function insertTableCategory(){
         $sql = ' INSERT INTO `categories` (`number`, `name`) VALUES
 (\'1\',\'Chinese Novels\'),
 (\'2\',\'Korean Novels\')        
        ';


         $stmt= $this->db->prepare($sql);
         $stmt->execute();
     }

    function fetchAll($table){
        $sql=' Select * from '.$table;
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();;
        return $products;
    }
}