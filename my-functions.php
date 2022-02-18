<?php

function formatPrice($cents_price): void
{
    echo $cents_price / 1000 . "€";
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

function convertWeight($weight){
    return $weight / 100;
}
