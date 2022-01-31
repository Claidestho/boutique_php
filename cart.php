<?php
include './exo-template/header.php';
include 'my-functions.php';
include 'products-list.php';

?>

    <style>
        .table {
            display: flex;
            justify-content: center;
        }

        table {
            border: 1px solid;

        }

        tr {
            border: 1px solid;
        }

        td {
            border: 1px solid;
            text-align: center;
        }
    </style>
    <h1>Récapitulatif de votre commande</h1>

    <p>Voici les détails de votre commande n°<?= rand(10000, 99999) ?> du <?= date("d.m.y") . " à " . date("H:i:s") ?>
        :</p>

    <div class="table">
        <table>
            <thead>
            <tr>
                <th colspan="2">Récapitulatif de votre commande</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Produit commandé</td>
                <td><?php if (isset($_GET["product"]) && is_string($_GET["product"])) {
                        echo $products[$_GET["product"]]["name"];
                    } else {
                        echo "ERREUR : LE PRODUIT CHOISI N'EST PAS VALIDE";
                    } ?></td>
            </tr>
            <tr>
                <td>Quantité</td>
                <td><?php if (isset($_GET["quantity"]) && filter_var($_GET["quantity"], FILTER_VALIDATE_INT)) {
                        echo $_GET["quantity"];
                    } else {
                        echo "ERREUR : LA QUANTITÉ INDIQUÉE N'EST PAS VALIDE";
                    } ?></td>
            </tr>
            <tr>
                <td>Remise (%)</td>
                <td><?= $products[$_GET["product"]]["discount_rate"] . "%" ?>
                </td>
            </tr>
            <tr>
                <td>Prix HT</td>
                <td><?= formatPrice(priceExcludingVAT(discountedPrice($products[$_GET["product"]]["price"], $products[$_GET["product"]]["discount_rate"])) * $_GET["quantity"]);?>
                </td>
            </tr>
            <tr>
                <td>TVA</td>
                <td><?= "20%" ?>
                </td>
            </tr>
            <tr>
                <td>Prix TTC</td>
                <td><?php

                    echo formatPrice(discountedPrice($products[$_GET["product"]]["price"], $products[$_GET["product"]]["discount_rate"]) * $_GET["quantity"]);

                    ?>


                </td>
            </tr>
            </tbody>
        </table>

    </div>


<?php include './exo-template/footer.php' ?>