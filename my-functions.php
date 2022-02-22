<?php
include_once './class/catalog.php';

function formatPrice($cents_price): string
{
    return $cents_price / 100 . "€";
}

function priceExcludingVAT($taxed_price): float
{
    return round($taxed_price / (1 + 0.2), 0);
}

function discountedPrice($original_price, $discount): float
{

    return $original_price - ($original_price * ($discount / 100));

}

function deliveryFees($baseFees)
{
    return $baseFees + ($baseFees * 0.1);
}

function convertWeight($weight)
{
    return $weight / 100;
}

function displayItem(Item $item)
{

    $avalaible = '';
    if ($item->isAvalaible()) {
        $avalaible = "OUI";
    } else {
        $avalaible = "NON";
    }

    $html = "<div class='items'><img src=" . $item->getImageUrl() .
        "><br><label><br>" . $item->getName() . "</label><br>
           <label>Prix : </label><label>" . formatPrice($item->getPrice()) . "</label><br>
           <label>Poids :</label>" . convertWeight($item->getWeight()) . "<br>
           <label> Stock : </label>" . $item->getQuantity() . "<br>
           <label>Dispo : </label>" . $avalaible . "
           <br> <label for='dropdown'> Choisissez la quantité</label><br/>
       <select name='quantity[]'>";

    for ($i = 0; $i < 100; $i++) {
        $html .= "<option value=" . $i . ">" . $i . "</option>";
    }

    $html .= "</select></div><input name='id[]' value=". $item->getId() . " type='hidden'>";

    return $html;


}

//" . . "
