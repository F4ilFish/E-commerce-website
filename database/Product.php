<?php
// Fetch products

class Product
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->connection)) return null;

        $this->db = $db;
    }

    public function getColumnValues($table, $column){
        $result = $this->db->connection->query("SELECT `{$column}` FROM `{$table}`");

        $resultArray = array();

        // Fetch data from product table one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;

    }

    // Fetch product
    public function getDataFromTable($table)
    {
        $result = $this->db->connection->query("SELECT * FROM `{$table}`");

        $resultArray = array();

        // Fetch data from product table one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    public function addProduct($name, $price, $brand, $category, $image, $color, $info){
        $this->db->connection->query("INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_brand`, `product_category`, `product_image`, `product_color`, `product_info`, `product_register_time`) VALUES (NULL, '$name', '$price', '$brand', '$category', '$image', '$color', '$info', current_timestamp())");
    }

    public function deleteProduct($product_id){
        $this->db->connection->query("DELETE FROM `product` WHERE `product_id` = '$product_id'");
    }

    public function getColumnsFromTable($table){
        $result = $this->db->connection->query("SELECT * FROM `{$table}`");

        $resultArray = mysqli_fetch_fields($result);

        return $resultArray;
    }

    // Get product by id
    public function getProductById($product_id, $table = 'product')
    {
        if (isset($product_id)) {
            $result = $this->db->connection->query("SELECT * FROM {$table} WHERE product_id={$product_id}");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }
}
