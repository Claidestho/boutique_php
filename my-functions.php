<?php

function formatPrice($cents_price): float{
    return $cents_price / 100;
}

function priceExcludingVAT($taxed_price): float{
    return ($taxed_price * 100) / (100 + 20);
}

function displayDiscountedPrice($og_price, $discount): float{

    return $og_price - ($og_price * ($discount / 100));

}