<?php

namespace kisa7081;

class Converter
{

    private $currency_list = [
        'USD' => 'Dollar',
        'MXN' => 'Peso',
        'GBP' => 'Pound',
        'RUB' => 'Ruble'
    ];

    private $keys;

    private $conversions;

    public function __construct()
    {
        $this->keys = array_keys($this->currency_list);
        $this->conversions = $this->createConversions($this->keys);
    }

    public function getCurrencyList()
    {
        return $this->currency_list;
    }

    public function getConversions()
    {
        return $this->conversions;
    }

    private function createConversions()
    {
        $conversions = [];
        $join = join(',', $this->keys);
        foreach ($this->keys as $key) {
            $url = 'https://api.exchangeratesapi.io/latest?base=' . $key . '&symbols=' . $join;
            $fp = fopen($url, 'r');
            $data = json_decode(stream_get_contents($fp));
            $d = $data->rates;
            $ar = [];
            foreach ($this->keys as $k) {
                array_push($ar, $d->$k);
            }
            $conversions[$key] = $ar;
        }

        return $conversions;
    }

    public function convert(float $amount = 0.0, String $current = 'USD', String $target = 'USD', bool $round)
    {
        $conversion = $this->conversions[$current];
        $converted = $amount * (float)$conversion[$target];
        if ($round) {
            $converted = round($converted, 0) . '.00';
        } else {
            $converted = round($converted, 2);
        }

        return $converted;
    }

}