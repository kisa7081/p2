<?php
require 'helpers.php';
require 'values.php';
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Project 2</title>
    <meta charset='utf-8'/>
    <link href='/css/app.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA"
          crossorigin="anonymous">
</head>

<body>

    <form method='GET' action='convert.php'>
        <label>Enter currency amount:
            <input type='text' name='amount' id='amount' value='<?php echo $amount ?>'/>
        </label>

        <label>Choose currency:
            <select name='curr' id='curr'>
                <?php foreach ($currency_list as $code => $value): ?>
                    <option value='<?php echo $code ?>' <?php if($code == $curr) echo 'selected' ?>><?php echo $value ?></option>
                <?php endforeach ?>
            </select>
        </label>
        <br>
        <br>
        <label>Choose currency to convert to:
            <select name='targ' id='targ'>
                <?php $i = 0 ?>
                <?php foreach ($currency_list as $code => $value): ?>
                    <option value='<?php echo $i++ ?>' <?php if($i-1 == $targ) echo 'selected' ?>><?php echo $value ?></option>
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
