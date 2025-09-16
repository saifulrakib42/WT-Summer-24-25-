<?php
class Product {
    private $conn;
    private $table = "products"; // adjust if table name differs

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $sql = "SELECT id, Name, Description, ProductImage, UnitPrice, InventoryQuantity 
                FROM " . $this->table . " 
                WHERE IsRemove = 0"; // show only active products
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
