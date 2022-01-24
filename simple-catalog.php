<?php

$products = ["iPhone", "iPad", "iMac"];
$products_length = count($products);

sort($products);
print_r($products);
echo "<br />", $products[0], "<br />";
echo $products[$products_length - 1];


?>