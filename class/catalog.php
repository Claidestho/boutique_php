<?php
include_once 'C:\xampp\htdocs\boutique_php\class\item.php';

class Catalog {
    protected array $items;
    public function __construct()
    {
        try {
        $db = new PDO('mysql:host=127.0.0.1;dbname=boutique_php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $catalog = $db->prepare('SELECT * FROM products LIMIT 3');
    $catalog->execute();
    $this->items = $catalog->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array|false
     */
    public function getItems(): bool|array
    {
        return $this->items;
    }


}

function displayCatalogue(Catalog $catalog): string
{

    $html = '';
    foreach ($catalog->getItems() as $item) {
        $product = new Item();
        $product->setName($item["name"]);
        $product->setPrice($item["price"]);
        $product->setDescription($item["description"]);
        $product->setAvalaible($item["avalaible"]);
        $product->setDiscountRate($item["discount_rate"]);
        $product->setWeight($item["weight"]);
        $product->setImageUrl($item["image_url"]);
        $product->setQuantity($item["quantity"]);
        $product->setId($item["id"]);


        $html .= displayItem($product);

    }
    return $html;
}
