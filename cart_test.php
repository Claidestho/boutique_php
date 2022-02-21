<?php
session_start();
include './exo-template/header.php';
include 'my-functions.php';
include 'database.php';
include 'carrier-list.php';

try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=boutique_php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$_SESSION = array_merge($_SESSION, $_POST);

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
$subTotal = 0;
$totalWeight = 0;



//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";


?>

    <style>
        .table {
            display: flex;
            justify-content: center;
        }

        form {
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

        h3 {
            text-align: center;
        }
    </style>
    <h1>Récapitulatif de votre commande</h1>
    <!--    <pre><b>--><?php //var_dump($_POST); ?><!--</b></pre>-->
    <p>Voici les détails de votre commande n°<?= rand(10000, 99999) ?> du <?= date("d.m.y") . " à " . date("H:i:s") ?>
        :</p>

<?php

$results = [];
$q = [];

for ($i = 0; $i < count($_POST['quantity']); $i++) {
    $results[] = dbExtractProduct($db, $_POST['id'][$i]);
    if ($_POST['quantity'][$i] > 0) {
        $q[] = $_POST['quantity'][$i];
    }
}


?>
    <div class="table">
        <table>
            <thead>
            <tr>
                <th colspan="2">Récapitulatif de votre commande</th>
            </tr>
            </thead>
            <tbody>

            <?php if(isset($_SESSION['quantity'])){
            foreach ($results as $key => $result) { ?>
            <?php if($_POST["quantity"][$key] > 0){ ?>
                <tr>
                    <td><b>Produit commandé</b></td>
                    <td><?php if (!empty($_POST)) {
                            echo "<b>". ucfirst($result['name']) . "</b>";
                        } else {
                            echo "ERREUR : LE PRODUIT CHOISI N'EST PAS VALIDE";
                        } ?>
                        <input type="hidden" name="name" value="<?php $result["name"] ?>">
                    </td>
                </tr>
                <tr>
                    <td>Quantité</td>
                    <td><?php if (filter_var($_POST["quantity"][$key], FILTER_VALIDATE_INT)) {
                            echo $_POST["quantity"][$key];
                        } else {
                            echo "ERREUR : LA QUANTITÉ INDIQUÉE N'EST PAS VALIDE";
                        } ?>
                        <input type="hidden" name="quantity" value="<?php $result["quantity"] ?>">
                    </td>
                </tr>


                <tr>
                    <td>Remise (%)</td>
                    <td><?php if (!empty($_POST)) {
                            echo $result["discount_rate"] . "%";
                        } else {
                            echo "ERREUR";
                        } ?>
                        <input type="hidden" name="discount_rate" value="<?php $result["discount_rate"] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Prix HT unitaire</td>
                    <td><?php if (!empty($_POST)) {
                            formatPrice(priceExcludingVAT(discountedPrice($result["price"], $result["discount_rate"]) * $_POST["quantity"][$key]));
                        } else {
                            echo "ERREUR";
                        }
                        $subTotal = $subTotal + (discountedPrice($result["price"], $result["discount_rate"]) * $_POST["quantity"][$key]);
                        $totalWeight = $totalWeight + $result["weight"];

                        ?><input type="hidden" name="price" value="<?php $result["price"] ?>">

                    </td>
                </tr>

            <?php } } ?>

            <tr>
                <td>TVA</td>
                <td><?= "20%" ?>
                </td>
            </tr>
                <tr>
                    <td><b>Sous total TTC</b></td>
                    <td><b><?php
                        echo formatPrice($subTotal);
                        ?></b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


<?php }

$carriers = displayCarriers($db);

if (!empty($results)) { ?>
    <h3>Choix du transporteur :</h3>

    <form method="POST">
        <select name="carrier">
            <?php
            foreach ($carriers as $key => $carrier) {
                echo "<option value=\"{$key}\">" . $carrier["name"] . "</option>";

            }

            ?>>
        </select>
        <input type="hidden" name="weight" value="<?= $totalWeight ?>">
        <input type="hidden" value="<?php $_POST ?>">
        <input type="submit" value="Valider">
    </form><br>

    <div class="table">

        <table>
            <thead>
            <tr>
                <th colspan="2">Choix du mode de livraison</th>
            </tr>
            </thead>
            <td>Frais de port</td>
            <td>
                <?php
                if (isset($_POST["carrier"])) {
                    if ($_POST['weight'] <= 500) {
                        echo $carriers[$_POST['carrier']];
                        $totalPrice = $carriers[$_POST["carrier"]]["price_500"];
                    } elseif ($_POST['weight'] <= 2000) {
                        formatPrice(deliveryFees($carriers[$_POST["carrier"]]["price_500"]));
                        $totalPrice = $carriers[$_POST["carrier"]]["price_2000"];
                    } elseif ($_POST['weight'] > 2001) {
                        echo $carriers[$_POST["carrier"]]["price_over"];
                        $totalPrice = $carriers[$_POST["carrier"]]["price_over"];
                    }
                } else {
                    echo "Veuillez choisir un transporteur dans la liste ci-dessus";
                }
                ?>

            </td>
            </tr>
            <td>Prix total TTC</td>
            <td><?php
                if (isset($_POST["carrier"]) && !is_string($totalPrice) && isset($_POST["quantity"])) {
                    echo formatPrice(discountedPrice($products[$_POST["product"]]["price"], $products[$_POST["product"]]["discount_rate"]) * $_POST["quantity"] + $totalPrice);
                } elseif (isset($_POST["carrier"]) && is_string($totalPrice) && isset($_POST["quantity"])) {

                    echo formatPrice(discountedPrice($products[$_POST["product"]]["price"], $products[$_POST["product"]]["discount_rate"]) * $_POST["quantity"]);
                } else {
                    echo "Veuillez choisir un transporteur dans la liste ci-dessus";
                }
                ?>


            </td>
            </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php include './exo-template/footer.php' ?>