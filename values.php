<?php
$currency_list = [
    'USD' => 'Dollar',
    'MXN' => 'Peso',
    'GBP' => 'Pound',
    'RUB' => 'Ruble'
];

function createConversions($keys){
    $conversions =[];
    foreach($keys as $key){
        $join = join(',', $keys);
        $url = 'https://api.exchangeratesapi.io/latest?base='.$key.'&symbols='.$join;
        $fp = fopen($url, 'r');
        $data = json_decode(stream_get_contents($fp));
        $d = $data->rates;
        $ar = [];
        foreach($keys as $k){
            array_push($ar, $d->$k);
        }
        $conversions[$key] = $ar;
    }
    return $conversions;
}

session_start();

if(isset($_SESSION['results'])){
    $curr = $_SESSION['results']['curr'];
    $targ = $_SESSION['results']['targ'];
    $amount = $_SESSION['results']['amount'];
    $converted = $_SESSION['results']['converted'];
    $round = $_SESSION['results']['round'];
    $timeValue = $_SESSION['results']['timeValue'];
}
else {
    $amount = 0;
    $curr = 'USD';
    $targ = 0;
    $timeValue = time();
    $conversions = createConversions(array_keys($currency_list));
}

session_unset();