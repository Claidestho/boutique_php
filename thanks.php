<?php
session_start();
include './exo-template/header.php';
include_once 'my-functions.php';
include_once 'database.php';
include_once './class/Rodents.php';


try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=boutique_php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

echo "<pre>";
var_dump($_POST);
echo "</pre>";
var_dump($_POST['id']);
var_dump($_POST['qty']);
?>


<?php


if(isset($_POST['qty']) && isset($_POST['id'])){

    insertOrderProduct($db, $_POST['qty'], $_POST['id'], date('Y-d-m'), 1, '0000000007');

}



?>




;<?php include './exo-template/footer.php'; ?>
