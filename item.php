<?php include './exo-template/header.php'; ?>

<?php
include 'my-functions.php';

$name = "Plateau";
$price = 10;
$picture = "https://www.pebbly.fr/361-large_default/plateau-de-service-en-bambou-m-33-x-21-cm.jpg";

echo $price, "<br />", $name, "<br />", "<img src=$picture>";

echo "<br /> Le prix est de $price euros";

?>

<?php include './exo-template/footer.php' ?>

