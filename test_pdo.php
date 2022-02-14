<?php include 'database.php'?>

<?php
try
{
    $db = new PDO('mysql:host=127.0.0.1;dbname=test_bdd;charset=utf8', 'lolo', 'bonjour38', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>

<?php

$customers_names = $db->prepare('SELECT first_name, last_name, city FROM customers');
$customers_names->execute();
$names = $customers_names->fetchAll();
echo "<pre>";
print_r($names);
echo "</pre>";
echo "mon nom est " . $names[0][1] . " , " . $names[0][0] . " " . $names[0][1];
?>
<h2>Displaying all the products from the order 1 :</h2>
<pre>
<?php

print_r(displayOrderProduct($db));
?></pre>

<h2>Displaying all the products :</h2>
<pre>
<?php

print_r(displayAllProducts($db));
?></pre>

<h2>Displaying out of stock products :</h2>
<pre>
<?php

print_r(displayOutOfStock($db));
?></pre>

<h2>Displaying today's benefit :</h2>
<pre>
<?php

print_r(displayTodayBenefit($db));
?></pre>

<?php

if(isset($_GET['test'])){
    deleteCustomersNoOrders($db);
}

insertNewCustomer($db,15, 25000, 'Pantoufle', 1, 'C trè le confort', 950000, 'image pantoufle', 58500, 2);