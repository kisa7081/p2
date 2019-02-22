<?php
require 'helpers.php';
require 'values.php';

$current = $_GET['current'];

$target = $_GET['target'];

$amount = $_GET['amount'];

$round = isset($_GET['round']);

$converter = $_SESSION['converter'][0];

$timeValue = $_GET['timeValue'];

$converted = $converter->convert($amount, $current, $target, $round);

session_start();
$_SESSION['results'] = [
    'current' => $current,
    'target' => $target,
    'amount' => $amount,
    'converted' => $converted,
    'round' => $round,
    'timeValue' => $timeValue
];

header('Location: index.php');