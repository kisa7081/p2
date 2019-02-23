<?php

namespace kisa7081;

class Converter
{
    #Properties
    /*
     * The $currency_list is used to get the conversion rates.
     * Also, the keys are used as option values in the
     * base currency dropdown, and the values are used for display.
     */
    private $currency_list = [
        'USD' => 'Dollar',
        'MXN' => 'Peso',
        'GBP' => 'Pound',
        'RUB' => 'Ruble'
    ];

    /*
     * This is an array of the keys of the $currency_list.
     * It's used to iterate through the different currencies.
     */
    private $keys;

    #Methods
    /*
     * Magic constructor method used to instantiate an instance of Converter.
     */
    public function __construct()
    {
        # Set up the values that will be used.
        $this->keys = array_keys($this->currency_list);
    }

    /*
     * Public method that returns the currency list.
     */
    public function getCurrencyList()
    {
        return $this->currency_list;
    }

    /*
     * Private method called by the constructor to get
     * the latest conversion rates.
     */
    public function createConversions()
    {
        $conversions = []; #Initailize the array.
        /*
         * $join is a String used in the URL to
         * list the conversion rates we want
         * for the "base."  The $keys are iterated over
         * to get the "base" value in the URL.
         */
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

    /*
     * Public method to do the actual conversion.
     * If $round is true, the value is rounded to the
     * nearest digit and ".00" is appended.  Otherwise,
     * it's rounded to the nearest hundredth.
     */
    public function convert($conversion, float $amount, bool $round = false)
    {
        $converted = $amount * (float)$conversion;
        if ($round) {
            $converted = round($converted, 0) . '.00';
        } else {
            $converted = round($converted, 2);
        }

        return $converted;
    }

}