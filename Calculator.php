<?php

include 'autoload.php';

function addition($number1, $number2)
{
	return $number1 + $number2;
}

$callbacks = [
	'addition',
	function($number1, $number2)
	{
		return $number1 - $number2;
	},
	[App\Calculator\Multiplication::class, 'multiplication'],
	[new App\Calculator\Division(), 'division'],
];

echo "Пара чисел: 5 10<br>";
foreach ($callbacks as $callback) {
	echo App\Calculator\Calculator::calculate(5, 10, $callback) . "<br>";
}
echo "Пара чисел: 100 10<br>";
foreach ($callbacks as $callback) {
	echo App\Calculator\Calculator::calculate(100, 10, $callback) . "<br>";
}
