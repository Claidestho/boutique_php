<?php
session_start();
include_once './exo-template/header.php';
include_once 'my-functions.php';
include_once 'database.php';
include_once 'carrier-list.php';

try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=boutique_php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$_SESSION = array_merge($_SESSION, $_POST);

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

$_SESSION['weight'] = 500;
$noProducts = 0;

foreach ($_SESSION['quantity'] as $amount) {
    if ($amount > 0) {
        $noProducts = $noProducts + 1;
    }
}


$subTotal = 0;
$totalWeight = 0;


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

        th {
            text-align: center;
        }

        .total {
            background-color: grey;
        }


    </style>
    <h1>Récapitulatif de votre commande</h1>
<?php if ($noProducts) { ?>
    <p>Voici les détails de votre commande n°<?= rand(10000, 99999) ?> du <?= date("d.m.y") . " à " . date("H:i:s") ?>
        :</p>

    <?php

    $results = [];
    $q = [];

    for ($i = 0; $i < count($_SESSION['quantity']); $i++) {
        $results[] = dbExtractProduct($db, $_SESSION['id'][$i]);

        if ($_SESSION['quantity'][$i] > 0) {
            $q[] = $_SESSION['quantity'][$i];
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

    <?php if (isset($_SESSION['quantity'])) {
        foreach ($results as $key => $result) { ?>
            <?php if ($_SESSION["quantity"][$key] > 0) { ?>
                <tr>
                    <td><b>Produit commandé</b></td>
                    <td><?php if ($noProducts) {
                            $id = $result['id'];
//                            $formData[$key]['id'] = $result['id'];
                            echo "<b>" . ucfirst($result['name']) . "</b>";
                        } else {
                            echo "ERREUR : LE PRODUIT CHOISI N'EST PAS VALIDE";
                        } ?>
                        <input type="hidden" name="name" value="<?php $result["name"] ?>">
                    </td>
                </tr>
                <tr>
                    <td>Quantité</td>
                    <td><?php if (filter_var($_SESSION["quantity"][$key], FILTER_VALIDATE_INT)) {
                            echo $_SESSION["quantity"][$key];
                            $qty = $_SESSION["quantity"][$key];
//                            $formData[$key]['qty'] = $_SESSION["quantity"][$key];
                        } else {
                            echo "ERREUR : LA QUANTITÉ INDIQUÉE N'EST PAS VALIDE";
                        } ?>
                        <input type="hidden" name="quantity" value="<?php $result["quantity"] ?>">
                    </td>
                </tr>


                <tr>
                    <td>Remise (%)</td>
                    <td><?php if ($noProducts) {
                            echo $result["discount_rate"] . "%";
                        } else {
                            echo "ERREUR";
                        } ?>
                        <input type="hidden" name="discount_rate" value="<?php $result["discount_rate"] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Prix HT unitaire</td>
                    <td><?php if (!empty($_SESSION)) {
                            echo formatPrice(priceExcludingVAT(discountedPrice($result["price"], $result["discount_rate"]) * $_SESSION["quantity"][$key]));
                        } else {
                            echo "ERREUR";
                        }
                        $subTotal = $subTotal + (discountedPrice($result["price"], $result["discount_rate"]) * $_SESSION["quantity"][$key]);
                        $totalWeight = $totalWeight + $result["weight"];

                        ?><input type="hidden" name="price" value="<?php $result["price"] ?>">

                    </td>
                </tr>

            <?php }
        } ?>

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
} else {
    echo "<h2>Erreur : Vous n'avez pas sélectionné de produit.</h2>";
}

$carriers = displayCarriers($db);


if ($noProducts) { ?>
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

        <input type="submit" value="Valider">
    </form><br>

    <div class="table">
        <form method="POST" action="thanks.php">
            <table>
                <thead>
                <tr>
                    <th colspan="2">Choix du mode de livraison</th>
                </tr>
                </thead>
                <tr>
                    <?php if (isset($_SESSION["carrier"])) { ?>
                    <td>Transporteur</td>
                    <td>
                        <?php
                        echo $carriers[$_SESSION['carrier']]['name'];
                        ?>
                    </td>
                </tr>
                <?php } else { ?>
                    <tr>
                        <td>Transporteur</td>
                        <td>
                            Veuillez choisir une transporteur dans la liste ci-dessus.
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>Frais de port</td>

                    <td>
                        <?php
                        if (isset($_SESSION["carrier"])) {
                            if ($_SESSION['weight'] <= 500) {
                                echo formatPrice($carriers[$_SESSION['carrier']]['price_500']);
                                $totalPrice = $carriers[$_SESSION["carrier"]]["price_500"];
                            } elseif ($_SESSION['weight'] <= 1000) {
                                echo formatPrice($carriers[$_SESSION['carrier']]['price_1000']);
                                $totalPrice = $carriers[$_SESSION['carrier']]['price_1000'];
                            } elseif ($_SESSION['weight'] > 1001) {
                                echo formatPrice($carriers[$_SESSION['carrier']]['price_over']);
                                $totalPrice = $carriers[$_SESSION['carrier']]['price_over'];
                            }
                        } else {
                            echo "Veuillez choisir un transporteur dans la liste ci-dessus";
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td class="total"><b>Prix total TTC</b></td>
                    <td class="total"><b><?php
                            if (isset($_SESSION["carrier"]) && !is_string($totalPrice) && isset($_SESSION["quantity"])) {
                                echo formatPrice($subTotal + $totalPrice);
                            } else {
                                echo "Veuillez choisir un transporteur dans la liste ci-dessus";
                            }
                            ?></b>


                    </td>
                </tr>
                </tbody>
            </table>

<!--            --><?php
//            echo "<pre>";
//            var_dump($formData);
//            echo "</pre>";
//            ?>

            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="qty" value="<?= $qty ?>">
            <input type="submit" value="Valider commande">
    </div>

    </form>
<?php } ?>

<?php include './exo-template/footer.php' ?>