<?php

function formatPrice($cents_price): void{
    echo $cents_price / 100 . "€";
}

function priceExcludingVAT($taxed_price): float{
    return ($taxed_price * 100) / (100 + 20);
}

function discountedPrice($original_price, $discount): float{

    return $original_price - ($original_price * ($discount / 100));

}