<?php

function displayOrderProduct($database)
{
    $function_result = $database->query('SELECT name, order_product.quantity, price
FROM products
    JOIN order_product
ON products.id = order_product.product_id
    JOIN orders ON orders.id = order_product.order_id
WHERE orders.id = 1'
    );
    $result = $function_result->fetchAll();
    return $result;

}

function displayAllProducts($database)
{
    $function_result = $database->prepare('SELECT *
FROM products LIMIT 5
'
    );
    $function_result->execute();
    $result = $function_result->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}


function displayOutOfStock($database)
{
    $function_result = $database->prepare('SELECT *  FROM products WHERE quantity = 0'
    );
    $function_result->execute();
    $result = $function_result->fetchAll();
    return $result;

}

function displayTodayBenefit($database)
{
    $function_result = $database->prepare('SELECT SUM(products.price * order_product.quantity) AS prix_total
FROM order_product
         JOIN products
              ON products.id = order_product.product_id
         JOIN orders 
             ON orders.id = order_product.order_id
WHERE orders.date = DATE( NOW() )

');
    $function_result->execute();
    $result = $function_result->fetchAll();
    return $result;

}

function deleteCustomersNoOrders($database)
{
    $function_result = $database->prepare('DELETE FROM customers WHERE customers.id NOT IN (SELECT customer_id FROM orders)');
    $function_result->execute();

}

function insertNewCustomer($database, $price, $name, $avalaible, $description, $weight, $img, $quantity, $cat)
{
    $function_result = $database->prepare('INSERT INTO `products` (price, name, avalaible, description, weight, image_url, quantity, category_id, productscol) VALUES (:price, :name, :avalaible, :description, :weight, :img, :quantity, :cat, "")');
    $function_result->bindParam('price', $price, PDO::PARAM_STR_CHAR);
    $function_result->bindParam('name', $name, PDO::PARAM_STR_CHAR);
    $function_result->bindParam('avalaible', $avalaible, PDO::PARAM_INT);
    $function_result->bindParam('description', $description, PDO::PARAM_STR_CHAR);
    $function_result->bindParam('weight', $weight, PDO::PARAM_INT);
    $function_result->bindParam('img', $img, PDO::PARAM_STR_CHAR);
    $function_result->bindParam('quantity', $quantity, PDO::PARAM_INT);
    $function_result->bindParam('cat', $cat, PDO::PARAM_STR_CHAR);
    $function_result->execute();
}

function dbExtractProduct($database, $id){
    $function_result = $database->prepare('
SELECT *
FROM products
WHERE id = :identifier
');
    $function_result->bindValue('identifier', $id);
    $function_result->execute();
    return $function_result->fetch(PDO::FETCH_ASSOC);

}

function displayCarriers($database){
    $function_result = $database->prepare('
SELECT *
FROM carriers
');
    $function_result->execute();
    $result = $function_result->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}

function createOrder($database, $quantity, $order_id, $product_id){
    $function_result = $database->prepare('INSERT INTO `order_product` (product_id, quantity, order_id) VALUES (:product_id, :quantity, :order_id)');
    $function_result->bindParam('quantity', $quantity, PDO::PARAM_INT);
    $function_result->bindParam('order_id', $order_id, PDO::PARAM_INT);
    $function_result->bindParam('product_id', $product_id, PDO::PARAM_INT);
    $function_result->execute();
}
