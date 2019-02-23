<?php
require 'Converter.php';

use kisa7081\Converter;

session_start();

if (!isset($_SESSION['converter'])) {
    $converter = new kisa7081\Converter();
    $_SESSION['converter'] = [$converter];
}

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $current = $results['current'];
    $target = $results['target'];
    $amount = $results['amount'];
    $converted = $results['converted'];
    $round = $results['round'];
    $timeValue = $results['timeValue'];
    $hasErrors = $results['hasErrors'];
    $errors = $results['errors'];
    $converter = $_SESSION['converter'][0];
    $currency_list = $converter->getCurrencyList();
    $_SESSION['results'] = null;
} else {
    $amount = 0;
    $current = 'USD';
    $target = 0;
    $timeValue = time();
    $hasErrors = false;
    $converter = $_SESSION['converter'][0];
    $currency_list = $converter->getCurrencyList();
    $conversions = $converter->getConversions();
}
