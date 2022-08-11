<?php
class numberstowords {
    function numberToWords($number) 
    {
        if (($number < 0) || ($number > 9999999999)) 
        {
            print("Number is out of range");
            exit;
        }
        $bill = floor($number / 1000000000);
        //Billion (bill)
        $number -= $bill * 1000000000;
        $mill = floor($number / 1000000);
        // Millions (mill)
        $number -= $mill * 1000000;
        $thou = floor($number / 1000);
        // Thousands (thou)
        $number -= $thou * 1000;
        $hun = floor($number / 100);
        // Hundreds (hun)
        $number -= $hun * 100;
        $tens = floor($number / 10);
        // Tens (tens)
        $n = $number % 10;
        // units
        $result = "";
        
        if ($bill) 
        {
            $result .= $this->numberToWords($bill) .  " Billion ";
        }
        if ($mill) 
        {
            $result .= $this->numberToWords($mill) .  " Million ";
        }
        if ($thou) 
        {
            $result .= (empty($result) ? "" : " ") .$this->numberToWords($thou) . " Thousand";
        }
        if ($hun) 
        {
            $result .= (empty($result) ? "" : " ") .$this->numberToWords($hun) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tenss = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($tens || $n) {
            if (!empty($result)) 
            {
                $result .= " and ";
            }
            if ($tens < 2) 
            {
                $result .= $ones[$tens * 10 + $n];
            } else {
                $result .= $tenss[$tens];
                if ($n) 
                {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result)) 
        {
            $result = "zero";
        }
        return $result;
    }
}


$obj = new numberstowords();
$number = 765000;
echo $obj->numberToWords($number);




function wordstoNumber($words) {
    // Replace all number words with an equivalent value
    $words = strtr(
        $words,
        array(
    'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9',
    'ten' => '10', 'eleven' => '11', 'twelve' => '12', 'thirteen' => '13', 'fourteen' => '14', 'fifteen' => '15', 'sixteen' => '16', 'seventeen' => '17', 'eighteen' => '18', 'nineteen' => '19',
    'twenty' => '20', 'thirty' => '30', 'forty' => '40', 'fifty' => '50', 'sixty' => '60', 'seventy' => '70', 'eighty' => '80', 'ninety' => '90',
    'hundred' => '100', 'thousand' => '1000', 'million' => '1000000', 'billion' => '1000000000'
)
    );

    // change all words to numbers
    $parts = array_map(
        function ($val) {
            return floatval($val);
        },
        preg_split('/[\s-]+/', $words)
    );

    $sentence = new SplStack; // Current work
    $sum   = 0; // Running total
    $last  = null;

    foreach ($parts as $part) {
        if (!$sentence->isEmpty()) {
            if ($sentence->top() > $part) {
                // Decreasing step, from hundreds to ones
                if ($last >= 1000) {
                    // If we drop from more than 1000 then we've finished the phrase
                    $sum += $sentence->pop();
                    // This is the first element of a new phrase
                    $sentence->push($part);
                } else {
                    // Drop down from less than 1000, just addition
                    // example "seventy one" -> "70 1" -> "70 + 1"
                    $sentence->push($sentence->pop() + $part);
                }
            } else {
                // Increasing step, like ones to hundreds
                $sentence->push($sentence->pop() * $part);
            }
        } else {
            
            $sentence->push($part);
        }

        $last = $part;
    }

    return $sum + $sentence->pop();
}
?>
<br>
<?php

$words = strtolower($obj->numberToWords($number));
echo wordsToNumber($words);
?>

