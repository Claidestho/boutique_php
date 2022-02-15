<?php include 'database.php' ?>
    <style>

        .catalog {
            display: flex;
            justify-content: center;
        }

        .order_area {
            display: flex;
            justify-content: center;
            font-size: larger;
            flex-direction: column;
        }

        img {
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
<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=test_bdd;charset=utf8', 'lolo', 'bonjour38', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<?php

$products = displayAllProducts($db);

//foreach ($products as $value => $item){
//    echo "<img src=$item[image_url]>";
//    echo $item["price"] . "<br>";
//    echo $item['name'];
//}

?>

<form method="POST" action="http://ptsv2.com/t/bonjour/post">
<?php foreach ($products as $value => $item) { ?>
    <div class="catalog">
        <div class="order_area">
            <img src=<?php echo ucfirst($item['image_url']) ?>>
            <h3><?php echo ucfirst($item['name']) ?></h3>
            <p>Price : <?php echo $item['price'] ?> </p>
            <p>Poids : <?php echo $item['weight'] ?></p>
            <p>Disponibilité : <?php echo $item['avalaible'] ?></p>
            <p>Quantité disponible : <?php echo $item['quantity'] ?></p>
            <select name="order_quantity">
                <?php for ($i = 0; $i < 100; $i++) : ?>
                    <option value=<?= "$i"; ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>

        </div>
    </div>

<?php } ?>
    <input type="submit">
</form>

<?php
if (isset($_POST) && !empty($_POST)) {
    insertNewCustomer($db, $_POST["price"], $_POST["name"], $_POST["avalaible"], $_POST["description"], $_POST["weight"], $_POST["image_url"], $_POST["quantity"], $_POST["category_id"]);
    echo "<h1>LE PRODUIT A BIEN ETE AJOUTE A LA BASE DE DONNEES</h1>";
} else {
    ?>
    <div class="form_space">
        <form action="" method="POST">
            <label>Nom du produit</label><br>
            <input required="required" name="name"><br>
            <label>Prix du produit</label><br>
            <input required="required" name="price"><br>
            <label>En stock ?</label><br>
            <select required="required" name="avalaible"><br>
                <option>1</option>
                <option>0</option>
            </select>
            <label>Description</label><br>
            <textarea required="required" name="description"></textarea><br>
            <label>Poids</label><br>
            <input required="required" name="weight"><br>
            <label>Lien de l'image</label><br>
            <input required="required" name="image_url"><br>
            <label>Stock</label><br>
            <input required="required" name="quantity"><br>
            <label>Catégorie</label><br>
            <input required="required" name="category_id"><br>
            <button type="submit">Envoyer</button>
            <br>
        </form>
    </div>

    <?php
}
$customers_names = $db->prepare('SELECT first_name, last_name, city FROM customers');
$customers_names->execute();
$names = $customers_names->fetchAll();
echo "<pre>";
print_r($names);
echo "</pre>";
echo "mon nom est " . $names[0][1] . " , " . $names[0][0] . " " . $names[0][1];
?>
    <h2>Displaying all the products from the order 1 :</h2>
    <pre>
<?php

print_r(displayOrderProduct($db));
?></pre>

    <h2>Displaying all the products :</h2>
    <pre>
<?php

print_r(displayAllProducts($db));
?></pre>

    <h2>Displaying out of stock products :</h2>
    <pre>
<?php

print_r(displayOutOfStock($db));
?></pre>

    <h2>Displaying today's benefit :</h2>
    <pre>
<?php

print_r(displayTodayBenefit($db));
?></pre>

<?php

//if (isset($_GET['test'])) {
//    deleteCustomersNoOrders($db);
//}

