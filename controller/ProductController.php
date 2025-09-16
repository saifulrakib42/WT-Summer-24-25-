<?php
require '../config/db.php';
require '../model/Product.php';

$db = new Database();
$conn = $db->getConnection();

$productObj = new Product($conn);
$products = $productObj->getAllProducts();

include '../view/Products.php';
