<?php
include 'my-functions.php';


$iphone = [
    "name" => "iphone",
    "price" => 45000,
    "weight" => 450,
    "discount" => 10,
    "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone11-select-2019-family_GEO_EMEA?wid=882&hei=1058&fmt=jpeg&qlt=80&.v=1567022219953"
];

$ipad = [
    "name" => "ipad",
    "price" => 15000,
    "weight" => 1200,
    "discount" => 5,
    "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/ipad-202109-gallery-1?wid=2822&hei=2400&fmt=jpeg&qlt=80&.v=1629916218000"
];

$imac = [
    "name" => "imac",
    "price" => 89500,
    "weight" => 3500,
    "discount" => 8,
    "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/imac-og-202008?wid=600&hei=315&fmt=jpeg&qlt=95&.v=1594849639000"
];

$products = [$iphone, $ipad, $imac];

for ($i = 0; $i < 3; $i++) {
    $products[$i]["price"] = formatPrice($products[$i]["price"]);


    echo "<pre>";
    print_r($products[$i]);
    echo "</pre>";
    echo "<br />";


}

?>