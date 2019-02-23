<?php
require 'helpers.php';
require 'values.php';
require 'Form.php';

use kisa7081\Form;

$form = new Form($_GET);

$errors = $form->validate(
    [
        'amount' => 'required|numeric|min:0'

    ]);

$current = $form->get('current');

$target = $form->get('target');

$amount = $form->get('amount');

$round = $form->has('round');

$timeValue = $form->get('timeValue');

if (!$form->hasErrors) {

    $converter = $_SESSION['converter'][0];

    $converted = $converter->convert($amount, $current, $target, $round);
}

session_start();
$_SESSION['results'] = [
    'current' => $current,
    'target' => $target,
    'amount' => $amount,
    'converted' => $converted,
    'round' => $round,
    'timeValue' => $timeValue,
    'hasErrors' => $form->hasErrors,
    'errors' => $errors
];

header('Location: index.php');