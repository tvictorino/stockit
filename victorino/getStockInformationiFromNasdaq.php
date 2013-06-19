<?php
error_reporting(4);
//$page = file_get_contents('http://www.nasdaq.com/symbol/aapl/real-time');
$page = file_get_contents('http://www.nasdaq.com/symbol/fb/real-time');

$doc = new DomDocument;

// We need to validate our document before refering to the id
$doc->loadHTML($page);

echo "Value is  " . $doc->getElementById('quotes_content_left__LastSale')->nodeValue . "\n";
echo "Percent is  " . $doc->getElementById('quotes_content_left__PctChange')->nodeValue . "\n";
echo "Volume is  " . $doc->getElementById('quotes_content_left__Volume')->nodeValue . "\n";
echo "Opened  " . $doc->getElementById('quotes_content_left__PreviousClose')->nodeValue . "\n";
echo "Higth  " . $doc->getElementById('quotes_content_left__TodaysHigh')->nodeValue . "\n";
echo "Low  " . $doc->getElementById('quotes_content_left__TodaysLow')->nodeValue . "\n";
?>
