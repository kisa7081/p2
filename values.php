<?php
require 'Converter.php'; # The class that does the currency conversions.

use kisa7081\Converter; # Namespace declaration.

$converter = new Converter();

session_start(); # Begin the session.

/*
 * The values from the request are retrieved if
 * "results" is set.  This means we are coming from the
 * convert.php page.  If not, initial/default values
 * get set from the index.php page.
 */
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
    $currency_list = $converter->getCurrencyList();
    $_SESSION['results'] = null;
} else {
    $amount = 0;
    $current = 'USD';
    $target = 0;
    $timeValue = time();
    $hasErrors = false;
    $converter = new Converter(); # Create Converter instance.
    $currency_list = $converter->getCurrencyList();

    /*
     * The conversions array is cached to
     * avoid fetching the conversion rates for each
     * request.  If the conversion rates were hard
     * coded, the Converter class could just use
     * the array as a property.
    */
    $conversions = $converter->createConversions();
    $_SESSION['conversions'] = $conversions;
}
