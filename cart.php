<?php
include './exo-template/header.php';
include 'my-functions.php';

?>

    <h1>Récapitulatif de votre commande</h1>

<p>Voici les détails de votre commande n°<?= rand(10000, 99999) ?> du <?= date("d.m.y") . " à " . date("H:i:s" )?> :</p>


<?php var_dump($_GET);?>















<?php include './exo-template/footer.php'?>