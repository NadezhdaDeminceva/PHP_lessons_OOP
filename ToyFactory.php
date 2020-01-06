<?php

namespace ToyFactory;

class ToyFactory
{
	public $toyNames = ['Кукла', 'Машинка', 'Мячик', 'Кубики', 'Кораблик'];
	public function createToy()
	{
		return new Toy($this->toyNames[rand(0, 4)], rand(1, 1000));
	}

	public function createSum()
	{
		$sum = 0;
		for ($i=1; $i <= rand(5, 20) ; $i++) { 
			$toy = $this->createToy();
			echo "$toy->name - $toy->price<br>";
			$sum += $toy->price;
		}
		echo "Итого - $sum";
	}
}

class Toy
{
	public $name;
	public $price;
	public function __construct($name, $price)
	{
		$this->name = $name;
		$this->price = $price;
	}
}

$toyFactory1 = new ToyFactory;
$toyFactory1->createSum();
$sum = 0;
for ($i=1; $i <= rand(5, 20) ; $i++) { 
	$toy = $toyFactory1->createToy();
	echo "$toy->name - $toy->price<br>";
	$sum += $toy->price;
}
echo "Итого - $sum";