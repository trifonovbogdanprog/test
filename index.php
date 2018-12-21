<?php

error_reporting(E_ALL | E_STRICT);

function isPrime($var) {
    if (!$n = intval($var)) {
        return false;
    }
    if (in_array($n, [2, 3])) {
        return true;
    }
    if ($n % 2 == 0) {
        return false;
    }
    $i = 3;
    $sqrt = intval(sqrt($n));
    while ($sqrt >= $i) {
        if ($n % $i == 0) {
            return false;
        }
        // next odd number
        $i += 2;
    }
    return true;
}

function getPrimes($var) {
    $res = [];
    if (!$n = intval($var)) {
        return $res;
    }
    $i = 1;
    while (++$i <= $n) {
        if (isPrime($i)) {
            $res[] = $i;
        }
    }
    return $res;
}

function getMaxPrimeFromSumPrimes($max = 100) {
    $n = 0;
    $numberSum = '?';
    $primes = [];
    while (true) {
        $_primes = getPrimes(++$n);
        $_numberSum = array_sum($_primes);
        if ($_numberSum >= $max) {
            return [
                'number' => $numberSum,
                'primes' => $primes,
            ];
        } elseif (isPrime($_numberSum)) {
            $numberSum = $_numberSum;
            $primes = $_primes;
        }
    }
}

function format(Array $arr) {
    if (isset($arr['number'], $arr['primes']) && count($arr['primes'])) {
        return sprintf("%d = %s<br><br>", $arr['number'], implode(' + ', $arr['primes']));
    }
}

// The longest sum of consecutive primes below one-thousand that adds to a prime, contains 21 terms, and equal to 953.
// This statement seems to be wrong.
/* < add "/" to the beginning of this line
  // contains 21 terms
  echo '<pre>';
  $res = getPrimes(73);
  print_r($res);
  echo 'count: ' . count($res);
  // but sum is: 791
  $sum = array_sum($res);
  echo "\n" . $sum;
  // but 791 is not prime
  echo isPrime($sum) ? ' is prime' : ' is not prime';
  echo '</pre>';
  die;
  // */

echo format(getMaxPrimeFromSumPrimes(100));
echo format(getMaxPrimeFromSumPrimes(1000));
echo format(getMaxPrimeFromSumPrimes(1000000));
