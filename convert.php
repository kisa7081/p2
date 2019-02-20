<?php
require 'helpers.php';
require 'values.php';



$curr = $_GET['curr'];

$targ = $_GET['targ'];

$conv = $conversions[$curr];

$amount = $_GET['amount'];

$converted = floatval($amount) * floatval($conv[$targ]);

$round = isset($_GET['round']);

if($round){
    $converted = round($converted, 0).'.00';
}
else {
    $converted = round($converted, 2);
}

//dump(isset($_GET['round']));
//die();
session_start();
$_SESSION['results'] = [
    'curr' => $curr,
    'targ' => $targ,
    'amount' => $amount,
    'converted' => $converted,
    'round' => $round
];

header('Location: index.php');