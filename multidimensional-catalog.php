<?php
include 'my-functions.php';

$products = [
    "iphone" => [
        "name" => "iphone",
        "price" => 45000,
        "price without VAT" => 0,
        "weight" => 450,
        "discount" => 10,
        "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone11-select-2019-family_GEO_EMEA?wid=882&hei=1058&fmt=jpeg&qlt=80&.v=1567022219953"
    ],
    "ipad" => [
        "name" => "ipad",
        "price" => 15000,
        "price without VAT" => 0,
        "weight" => 1200,
        "discount" => 5,
        "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/ipad-202109-gallery-1?wid=2822&hei=2400&fmt=jpeg&qlt=80&.v=1629916218000"
    ],
    "imac" => [
        "name" => "imac",
        "price" => 89500,
        "price without VAT" => 0,
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





echo "<h2>Boucle foreach</h2>";

foreach ($products as $product){
    foreach ($product as $values){
        $product["price"] = formatPrice($product["price"]);
        $product["price without VAT"] = priceExcludingVAT($product["price"]);

        break;
    }
    echo "<pre>";
    print_r($product) ;
    echo "</pre>";

}


