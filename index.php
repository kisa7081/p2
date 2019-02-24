<?php
require 'helpers.php';
require 'values.php';
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Project 2</title>
    <meta charset='utf-8'/>
    <link href='css/styles.css' rel='stylesheet'>

</head>

<body>
<section id='main'>
    <header>
        <h1 id='title'>
            Currency Converter
        </h1>
        <p id='info'>
            Currency conversion rates are current as of:
            <br>
            <?= date('Y/m/d H:I:s T', $timeValue) ?>
            <br>
            Reload the page to get the latest rates.
        </p>
    </header>
    <form method='GET' action='convert.php'>
        <input type='hidden' name='timeValue' value='<?= $timeValue ?>'>

        <label>Enter currency amount:
            <input type='text' name='amount' id='amount' value='<?= $amount ?>'/>
        </label>
        <br>
        <br>
        <label>Choose currency:
            <select name='current' id='current'>
                <?php foreach ($currency_list as $code => $value): ?>
                    <option value='<?= $code ?>' <?php if ($code == $current) echo 'selected' ?>><?= $value ?></option>
                <?php endforeach ?>
            </select>
        </label>
        <br>
        <br>
        <label>Choose currency to convert to:
            <select name='target' id='target'>
                <?php $i = 0 ?>
                <?php foreach ($currency_list as $code => $value): ?>
                    <option value='<?= $i ?>' <?php if ($i == $target) echo 'selected' ?>><?= $value ?></option>
                    <?php $i++ ?>
                <?php endforeach ?>
            </select>
        </label>
        <br>
        <br>
        <label>
            Round value to nearest whole number?
            <input type='checkbox'
                   name='round'
                   id='round'
                   value='true' <?php if ($round) echo 'checked' ?>>
        </label>
        <br>
        <br>
        <input type='submit' value='Convert' >
    </form>
    <br>
    <br>
    <?php if (isset($converted)) : ?>

        <div class='alert alert-info'>
            The converted amount is: <?= $converted ?>
        </div>

    <?php endif; ?>
    <?php if ($hasErrors) : ?>
        <div class='alert alert-danger'>
                <?php foreach ($errors as $error) : ?>
                    <?= $error ?>
                    <br>
                <?php endforeach ?>
        </div>
    <?php endif ?>
</section>
</body>

</html>
