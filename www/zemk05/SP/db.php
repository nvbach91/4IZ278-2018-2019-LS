<?php require_once 'ProductsDB.php'; 
      require_once  'UsersDB.php';
      require_once 'CategoriesDB.php'; 
      require_once 'OrdersDB.php';
      require_once 'CartItemsDB.php';

$productsDB = new ProductsDB('products_eshop');
$usersDB = new UsersDB('users_eshop');
$categoriesDB = new CategoriesDB('categories_eshop');
$ordersDB = new OrdersDB('orders_eshop');
$cartItemsDB = new CartItemsDB('cart_items_eshop');

?>