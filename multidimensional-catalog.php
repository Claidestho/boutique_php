<?php include './exo-template/header.php';
include 'my-functions.php';
include 'products-list.php'; ?>
<style>

    .form_space {
        display: flex;
        justify-content: center;
        font-size: larger;
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
    <div class="form_elements">

        <form method="GET" action="cart.php">
            <img src="<?php echo $products["pasteque"]["image"]; ?>"><br>
            <label>pasteque do Brazil</label><br>
<!--                        <select name="product">-->
<!--            -->
<!--                            --><?php
//                            foreach ($products as $key) {
//                                echo "<option value=\"{$key["name"]}\">" . $key["name"] . "</option>";
//
//                            }
//
//                            ?><!-->-->
<!--                        </select>-->
            <label class="initial_price">Prix :<?php formatPrice($products["pasteque"]["price"]) ?></label><br>
            <label class="promo">PROMOTION
                : <?php formatPrice(discountedPrice($products["pasteque"]["price"], $products["pasteque"]["discount_rate"])); ?> </label>

            <br> <label for="dropdown"> Choisissez la quantité</label><br/>
            <select name="quantity">
                <?php for ($i = 1; $i < 100; $i++) : ?>
                    <option value=<?= "$i"; ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
            <input type="hidden" name="product" value="pasteque">
            <input type="submit" value="Commander">
            <?php if (isset($_GET["quantity"]) && $_GET["quantity"] != 0) {
                echo "<br>Vous avez commandé " . $_GET["quantity"] . " pasteque pour un prix total de ";
                formatPrice(discountedPrice($products["pasteque"]["price"], $products["pasteque"]["discount_rate"]) * $_GET["quantity"]);
            } ?>

    </div>
</div>
</form>


<?php include './exo-template/footer.php'; ?>

