<?php
$currency_list = [
    'USD' => 'Dollar',
    'GBP' => 'Pound',
    'EUR' => 'Euro',
    'RUP' => 'Ruble'
];

$conversions = [
    'USD' => [1, 2, 3, 4],
    'GBP' => [2, 1, 4, 3],
    'EUR' => [4, 3, 1, 2],
    'RUP' => [3, 4, 2, 1]
];

//$currency_codes = array_keys($currency_list);


//dump($currency_codes);

session_start();

if(isset($_SESSION['results'])){

    $curr = $_SESSION['results']['curr'];
    $targ = $_SESSION['results']['targ'];
    $amount = $_SESSION['results']['amount'];
    $converted = $_SESSION['results']['converted'];
    $round = $_SESSION['results']['round'];
}
else {
    $amount = 0;
    $curr = 'USD';
    $targ = 0;
}

session_unset();