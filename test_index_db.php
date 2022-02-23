<?php
session_start();
include './exo-template/header.php';
include_once 'my-functions.php';
include_once 'database.php';
include_once './class/item.php';
include_once './class/catalog.php';
?>

<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=boutique_php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

$products = displayAllProducts($db);




$catalogue = new Catalog();




echo '<br>';
echo '<br>';
//echo "<pre>";
//var_dump($products);
//echo "</pre>";

?>
<button>Ajouter un produit</button>
<button>Supprimer un produit</button>
<style>
    .form_space {
        display: flex;
        justify-content: center;
        font-size: larger;
        flex-direction: row-reverse;
    }

    .form_elements {
        text-align: center;
        margin-bottom: 50px;
        border: 1px grey solid;
        border-radius: 25%;
        padding: 10%;
    }

    form img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }

    .initial_price {
        text-decoration: line-through;
    }

    .promo {

    }
</style>
<div class="form_space">
    <form method="POST" action="cart_test.php">

        <?php echo displayCatalogue($catalogue); ?>


        <input type="submit" value="Commander">
    </form>

</div>
<?php include './exo-template/footer.php'; ?>



    <!--        --><?php //foreach ($products as $key => $product) { ?>
    <!--            --><?php
    //
    //            ?><!--  -->
    <!---->
    <!--            <div class="form_elements">-->
    <!---->
    <!---->
    <!--                <img src="--><?php //echo $product["image_url"]; ?><!--"><br>-->
    <!--                <label>--><?php //echo "<b>" . ucfirst($product["name"]) . "</b>"; ?><!--</label><br>-->
    <!--                <label class="initial_price">Prix :--><?php //formatPrice($product["price"]) ?><!--</label><br>-->
    <!--                <b><label class="promo">PROMOTION-->
    <!--                        : </label></b> <br>-->
    <!--                <label>--><?php //formatPrice(discountedPrice($product["price"], $product["discount_rate"])); ?><!-- </label><br>-->
    <!--                <label><b>Description :</b> </label><br>-->
    <!--                <p>--><?php //echo $product["description"]; ?><!--</p>-->
    <!---->
                    <br> <label for="dropdown"> Choisissez la quantité</label><br/>
                    <select name="quantity[]">
                        <?php for ($i = 0; $i < 100; $i++) : ?>
                            <option value=<?= "$i"; ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
    <!--                <input name="id[]" value=--><?php //echo $product["id"] ?><!-- type="hidden">-->
    <!---->
    <!--            </div>-->
    <!---->
    <!---->
    <!--        --><?php session_destroy(); ?>