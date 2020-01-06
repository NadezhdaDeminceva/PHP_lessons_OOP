<?php
namespace BlackBox;

class BlackBox
{
	private $data;
	public function addLog($message)
	{
		$this->data[] = $message;
	}

	public function getDataForEngineer(Engineer $engineer)
	{
		return $this->data;
	}
}

class Plane
{
	private $blackBox;
	public function __construct($blackBox)
	{
		$this->blackBox = $blackBox;
	}

	public function flyAndCrush($message)
	{
		$this->flyProcess($message);
		$this->crushProcess();
	}

	public function flyProcess($message)
	{
		$this->addLog($message);
	}

	private function crushProcess()
	{
		$this->addLog("процесс крушения<br>");
	}

	protected function addLog($message)
	{
		$this->blackBox->addLog($message);
	}

	public function getBoxForEngineer(Engineer $engineer)
	{
		return $engineer->setBox($this->blackBox);
	}
}

class Engineer
{
	public function setBox(BlackBox $blackBox)
	{
		return $blackBox->getDataForEngineer($this);
	}

	public function takeBox(Plane $plane)
	{
		return $plane->getBoxForEngineer($this);
	}

	public function decodeBox($data)
	{
		foreach ($data as $string) {
			echo $string;
		}
	}
}

class AnotherPlane extends Plane {}

$plane1 = new Plane($blackBox1 = new BlackBox);
$plane1->flyAndCrush("процесс полета<br>");
$engineer1 = new Engineer;
$engineer1->decodeBox($engineer1->takeBox($plane1));

$plane2 = new AnotherPlane($blackBox2 = new BlackBox);
$plane2->flyAndCrush("другой лог во время полета<br>");
$engineer1->decodeBox($engineer1->takeBox($plane2));