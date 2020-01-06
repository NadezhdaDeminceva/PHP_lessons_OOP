<?php

namespace App\Calculator;

class Calculator
{
	public static function calculate($number1, $number2, callable $callback)
	{
		return $callback($number1, $number2);
	}
}