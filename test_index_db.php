<?php include './exo-template/header.php';
include 'my-functions.php';
include 'database.php'; ?>

<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'lolo', 'bonjour38', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$products = displayAllProducts($db);
?>


<style>

    .form_space {
        display: flex;
        justify-content: center;
        font-size: larger;
        flex-direction: row-reverse;
    }

    form img {
        width: 200px;
        height: 200px;
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

<?php foreach ($products as $product => $value) { ?>


        <div class="form_elements">


                <img src="<?php echo $value["image"]; ?>"><br>
                <label><?php echo $value["name"]; ?></label><br>
                <label class="initial_price">Prix :<?php formatPrice($value["price"]) ?></label><br>
                <label class="promo">PROMOTION
                    : <?php formatPrice(discountedPrice($value["price"], $value["discount_rate"])); ?> </label>

                <br> <label for="dropdown"> Choisissez la quantité</label><br/>
                <select name="products[<?= $product ?>][quantity]">
                    <?php for ($i = 0; $i < 100; $i++) : ?>
                        <option value=<?= "$i"; ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <input type="hidden" name="<?= $value["name"] ?>" value="<?= $value ?>">


        </div>



<?php } ?>
    <input type="submit" value="Commander">
</form>

</div>
<?php include './exo-template/footer.php'; ?>

