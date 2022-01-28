<?php include './exo-template/header.php';
include 'my-functions.php';


$products = [
    "ananas" => [
        "name" => "ananas",
        "price" => 45000,
        "discount_rate" => 50,
        "weight" => 450,
        "discount" => 10,
        "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone11-select-2019-family_GEO_EMEA?wid=882&hei=1058&fmt=jpeg&qlt=80&.v=1567022219953"
    ],
    "pastèque" => [
        "name" => "pastèque",
        "price" => 15000,
        "discount_rate" => 15,
        "weight" => 1200,
        "discount" => 5,
        "image" => "https://static.lecomptoirlocal.fr/img/produits/43ad4dfa-6353-451c-aa01-59b6f89b6ddc/large.jpg"
    ],
    "goyave" => [
        "name" => "goyave",
        "price" => 89500,
        "discount_rate" => 65,
        "weight" => 3500,
        "discount" => 8,
        "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/imac-og-202008?wid=600&hei=315&fmt=jpeg&qlt=95&.v=1594849639000"
    ]
];
//echo "<pre>";
//print_r($products);
//echo "</pre>";
//echo "<pre>";
//var_dump($products);
//echo "</pre>";
//print_r($products["iphone"]);


//$product["price"] = formatPrice($product["price"]);
//$product["price without VAT"] = priceExcludingVAT($product["price"]);
//$product["discounted price"] = displayDiscountedPrice($product["price"], $product["discount_rate"]);
//
//
//echo "<pre>";
//var_dump($products);
//echo "</pre>";
//?>
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

        <form method="GET">
            <img src="<?php echo $products["pastèque"]["image"]; ?>"><br>
            <label>Pastèque</label><br>
            <label class="initial_price">Prix :<?php formatPrice($products["pastèque"]["price"]) ?></label><br>
            <label class="promo">PROMOTION
                : <?php formatPrice(discountedPrice($products["pastèque"]["price"], $products["pastèque"]["discount_rate"]));?> </label>

         <br>   <label for="dropdown"> Choisissez la quantité</label><br/>
            <select name="quantity">
                <?php for ($i = 0; $i < 100; $i++) : ?>
                    <option value=<?= "$i"; ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
            <input type="submit" value="Commander">
            <?php if (isset($_GET["quantity"]) && $_GET["quantity"] != 0) {
                echo "<br>Vous avez commandé " . $_GET["quantity"] . " pastèque pour un prix total de ";
                formatPrice(discountedPrice($products["pastèque"]["price"], $products["pastèque"]["discount_rate"]) * $_GET["quantity"]);
            } ?>

    </div>
</div>
</form>


<?php include './exo-template/footer.php'; ?>

