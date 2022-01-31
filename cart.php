<?php
include './exo-template/header.php';
include 'my-functions.php';
include 'products-list.php';
include 'carrier-list.php';
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
                <td><?php if (isset($_GET["product"])) {
                        echo $products[$_GET["product"]]["discount_rate"] . "%";
                    } else {
                        echo "ERREUR";
                    } ?>
                </td>
            </tr>
            <tr>
                <td>Prix HT</td>
                <td><?php if (isset($_GET["product"])) {
                        formatPrice(priceExcludingVAT(discountedPrice($products[$_GET["product"]]["price"], $products[$_GET["product"]]["discount_rate"])) * $_GET["quantity"]);
                    } else {
                        echo "ERREUR";
                    }
                    ?>

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
                    if (isset($_GET["product"])) {
                        echo formatPrice(discountedPrice($products[$_GET["product"]]["price"], $products[$_GET["product"]]["discount_rate"]) * $_GET["quantity"]);
                    } else {
                        echo "ERREUR";
                    }
                    ?>


                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <h3>Choix du transporteur :</h3>
    <form>
        <select name="carrier">

            <?php
            foreach ($carriers as $key => $carrier) {
                echo "<option value=\"{$key}\">" . $carrier["name"] . "</option>";

            }

            ?>>
        </select>
        <input type="hidden" name="product" value="<?php  echo $_GET["product"] ?>">
        <input type="hidden" name="quantity" value="<?php echo $_GET["quantity"] ?>">
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
                if (isset($_GET["carrier"])) {
                    if ($products[$_GET["product"]]["weight"] <= 500) {
                        formatPrice($carriers[$_GET["carrier"]]["price_500"]);
                        $totalPrice = $carriers[$_GET["carrier"]]["price_500"];
                    } elseif ($products[$_GET["product"]]["weight"] <= 2000) {
                        formatPrice($carriers[$_GET["carrier"]]["price_2000"]);
                        $totalPrice = $carriers[$_GET["carrier"]]["price_2000"];
                    } elseif ($products[$_GET["product"]]["weight"] > 2001) {
                        echo $carriers[$_GET["carrier"]]["price_over"];
                        $totalPrice = $carriers[$_GET["carrier"]]["price_over"];
                    }
                }else{
                    echo "Veuillez choisir un transporteur dans la liste ci-dessus";
                }
                ?>

            </td>
            </tr>
            <td>Prix total TTC</td>
            <td><?php
if (isset($_GET["carrier"]) && !is_string($totalPrice)){
    echo formatPrice(discountedPrice($products[$_GET["product"]]["price"], $products[$_GET["product"]]["discount_rate"]) * $_GET["quantity"] + $totalPrice);
}elseif(isset($_GET["carrier"]) && is_string($totalPrice)){

    echo formatPrice(discountedPrice($products[$_GET["product"]]["price"], $products[$_GET["product"]]["discount_rate"]) * $_GET["quantity"]);
}

else{
    echo "Veuillez choisir un transporteur dans la liste ci-dessus";
}
                ?>


            </td>
            </tr>
            </tbody>
        </table>
    </div>

?>
<?php include './exo-template/footer.php' ?>