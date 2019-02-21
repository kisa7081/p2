<?php
require 'helpers.php';
require 'values.php';
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Project 2</title>
    <meta charset='utf-8'/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA"
          crossorigin="anonymous">
    <link href='/css/styles.css' rel='stylesheet'>

</head>

<body>
    <header>
    <h1>
        Currency Converter
    </h1>
    <h2>
        Currency conversion rates are current as of:
        <br>
        <?=date('Y/m/d H:I:s',$timeValue)?>
        <br>
        Reload the page to get the latest rates.
    </h2>
    </header>
    <form method='GET' action='convert.php'>
        <input type='hidden' name='timeValue' value='<?=$timeValue ?>'>

        <label>Enter currency amount:
            <input type='text' name='amount' id='amount' value='<?=$amount ?>'/>
        </label>

        <label>Choose currency:
            <select name='current' id='current'>
                <?php foreach ($currency_list as $code => $value): ?>
                    <option value='<?=$code ?>' <?php if($code == $current) echo 'selected' ?>><?=$value ?></option>
                <?php endforeach ?>
            </select>
        </label>
        <br>
        <br>
        <label>Choose currency to convert to:
            <select name='target' id='target'>
                <?php $i = 0 ?>
                <?php foreach ($currency_list as $code => $value): ?>
                    <option value='<?=$i ?>' <?php if($i == $target) echo 'selected' ?>><?=$value ?></option>
                    <?php $i++ ?>
                <?php endforeach ?>
            </select>
        </label>
        <br>
        <br>
        <label>
            Round value to nearest whole number?
            <input type='checkbox' name='round' id='round' value='true' <?php if(isset($round) and $round) echo 'checked' ?>>
        </label>
        <br>
        <br>
        <input type='submit' value='Convert'>
    </form>
    <br>
    <br>
    <?php if (isset($converted)) : ?>

        <div class='alert alert-info' role='alert'>
            The converted amount is: <?= $converted ?>
        </div>

    <?php endif; ?>

</body>

</html>
