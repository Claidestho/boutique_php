<?php

$carriers = [
    "la_poste" => [
        "name" => "La Poste",
        "price_500" => 500,
        "price_2000" => deliveryFees(500),
        "price_over" => "GRATUIT !"
    ],
    "dhl" => [
        "name" => "DHL",
        "price_500" => 700,
        "price_2000" => deliveryFees(700),
        "price_over" => "GRATUIT !"
    ],
    "ups" => [
        "name" => "UPS",
        "price_500" => 450,
        "price_2000" => deliveryFees(450),
        "price_over" => "GRATUIT !"
    ]
];