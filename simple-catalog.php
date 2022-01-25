<?php

$products = ["iPhone", "iPad", "iMac"];
$products_length = count($products);

sort($products);
print_r($products);
//echo "<br />", $products[0], "<br />";
//echo $products[$products_length - 1];

echo "<h2>Boucle while</h2>";

$i = 0;
while($i < $products_length){
    echo "<br />",$products[$i], "<br />";
    $i++;
}

echo "<h2>Boucle for</h2>";/

for($count = 0; $count < $products_length; $count++){
    echo "<br />",$products[$count], "<br />";
}
echo "<h2>Boucle foreach</h2>";

foreach($products as $product){
    echo "<br />",$product, "<br />";
}

echo "<h2>Boucle do_while</h2>";

$x = 0;
do{
    echo "<br />",$products[$x], "<br />";
    $x++;

}while($x < $products_length);

