<?php
require 'helpers.php';
require 'Form.php';
require 'MyForm.php';
require 'Converter.php'; # The class that does the currency conversions.

use kisa7081\Converter; # Namespace declaration.

use Kisa7081\MyForm;

$form = new MyForm($_GET); # Using a "GET" request object

/*
 * The "timeValue" is simply used for display purposes.
 */
$timeValue = $form->get('timeValue');

# Server side check for errors.
$errors = $form->validate(
    [
        # The "amount" value is required and
        # must be a positive number.
        ['amount', 'amount', 'required|numeric|min:0']
    ]);

$amount = $form->get('amount'); # The amount to be converted

$current = $form->get('current'); # Currency of "amount."

$target = $form->get('target'); # Currency to be converted to.

/*
 * If $round is true, the value is rounded to the
 * nearest digit and ".00" is appended.
 */
$round = $form->has('round');

session_start(); # Start the session.

/*
 * If there are no errors, proceed with the conversion.
 * Otherwise skip it and return to index.php.
 */
if (!$form->hasErrors) {
    # Begin by getting the stored conversion values.
    $conversions = $_SESSION['conversions'];
    $converter = new \kisa7081\Converter(); #new instance of Converter.
    /*
     * Here the conversion value is taken from the array. The "current"
     * value is the key for an array of conversions for a base currency,
     * and "target" is the index of the rate.
     */
    $converted = $converter->convert($conversions[$current][$target], $amount, $round);
}
/*
 * Store the various values in the session to be
 * passed to values.php.
 */
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

header('Location: index.php'); # Go back to the index.php page.