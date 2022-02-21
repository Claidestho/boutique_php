<?php

class Catalog {
    protected array $items;
    function __construct()
    {
        try {
        $db = new PDO('mysql:host=127.0.0.1;dbname=boutique_php;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $catalog = $db->prepare('SELECT * FROM products');
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
        $product = new Catalog();
        $product->setName($item["name"]);
        $product->setName($item["price"]);
        $product->setName($item["description"]);

        $html .= displayItem($product);

    }
    return $html;
}
