<?php
include './exo-template/header.php';
include 'my-functions.php';
include 'products-list.php';
include 'carrier-list.php';

$results = [];
$subTotal = 0;
$totalWeight = 0;

foreach ($_POST["products"] as $product => $value) {
    if ($value["quantity"] > 0) {
        $results[$product] = $products[$product];
        $results[$product]["quantity"] = $value["quantity"];
    }
}
echo "<pre>";
var_dump($results);
echo "</pre>";

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

    <div class="table">
        <table>
            <thead>
            <tr>
                <th colspan="2">Récapitulatif de votre commande</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $result) { ?>
                <tr>
                    <td>Produit commandé</td>
                    <td><?php if (is_string($result["name"])) {
                            echo $result["name"];
                        } else {
                            echo "ERREUR : LE PRODUIT CHOISI N'EST PAS VALIDE";
                        } ?>
                        <input type="hidden" name="name" value="<?php $result["name"]?>">
                    </td>
                </tr>
                <tr>
                    <td>Quantité</td>
                    <td><?php if (filter_var($result["quantity"], FILTER_VALIDATE_INT)) {
                            echo $result["quantity"];
                        } else {
                            echo "ERREUR : LA QUANTITÉ INDIQUÉE N'EST PAS VALIDE";
                        } ?>
                        <input type="hidden" name="quantity" value="<?php $result["quantity"]?>">
                    </td>
                </tr>


                <tr>
                    <td>Remise (%)</td>
                    <td><?php if (!empty($results)) {
                            echo $result["discount_rate"] . "%";
                        } else {
                            echo "ERREUR";
                        } ?>
                        <input type="hidden" name="discount_rate" value="<?php $result["discount_rate"]?>">
                    </td>
                </tr>

                <tr>
                    <td>Prix HT unitaire</td>
                    <td><?php if (!empty($results)) {
                            formatPrice(priceExcludingVAT(discountedPrice($result["price"], $result["discount_rate"]) * $result["quantity"]));
                        } else {
                            echo "ERREUR";
                        }
                        $subTotal = $subTotal + (discountedPrice($result["price"], $result["discount_rate"]) * $result["quantity"]);
                        $totalWeight = $totalWeight + $result["weight"];
                        ?><input type="hidden" name="price" value="<?php $result["price"]?>">

                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td>TVA</td>
                <td><?= "20%" ?>
                </td>
            </tr>
            <tr>
                <td>Sous total TTC</td>
                <td><?php
                    echo formatPrice($subTotal);
                    ?>


                </td>
            </tr>
            </tbody>
        </table>
    </div>
<?php if (!empty($results)) { ?>
    <h3>Choix du transporteur :</h3>

    <form>
        <select name="carrier">
            <?php
            foreach ($carriers as $key => $carrier) {
                echo "<option value=\"{$key}\">" . $carrier["name"] . "</option>";

            }

            ?>>
        </select>
        <input type="hidden" name="product" value="<?php echo $_POST["product"] ?>">
<!--        <input type="hidden" name="quantity" value="--><?php //$data_string;?><!--">-->
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
                    if ($totalWeight <= 500) {
                        formatPrice($carriers[$_POST["carrier"]]["price_500"]);
                        $totalPrice = $carriers[$_POST["carrier"]]["price_500"];
                    } elseif ($totalWeight <= 2000) {
                        formatPrice($carriers[$_POST["carrier"]]["price_2000"]);
                        $totalPrice = $carriers[$_POST["carrier"]]["price_2000"];
                    } elseif ($totalWeight > 2001) {
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