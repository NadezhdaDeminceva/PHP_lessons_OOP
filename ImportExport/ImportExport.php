<?php

namespace ImportExport;

interface Reader
{
	public function read(): array;
}

interface Writer
{
	public function write(array $data);
}

interface Converter
{
	public function convert($item);
}

class Import
{
	private $reader;
	private $writer;
	private $converters = [];

	public function from(Reader $reader)
	{
		$this->reader = $reader;
		return $this;
	}

	public function to(Writer $writer)
	{
		$this->writer = $writer;
		return $this;
	}

	public function with(Converter $converter)
	{
		$this->converters[] = $converter;
		return $this;
	}

	public function execute()
	{
		$data = [];
		foreach ($this->reader->read() as $item) {
			foreach ($this->converters as $converter) {
				$item = $converter->convert($item);
			}
			$data[] = $item;
		}
		$this->writer->write($data);
	}
}

class FileReader implements Reader
{
	private $pathFrom;
	public function __construct($pathFrom)
	{
		$this->pathFrom = $pathFrom;
	}
	public function read(): array
	{
		$file = fopen($this->pathFrom, 'r');
		$fileArray = [];
		while (! feof($file)) {
			$fileArray[] = fgets($file);
		}
		fclose($file);
		return $fileArray;
	}
}

class FileWriter implements Writer
{
	private $pathTo;
	public function __construct($pathTo)
	{
		$this->pathTo = $pathTo;
	}
	public function write(array $data)
	{
		file_put_contents($this->pathTo, $data);
	}
}

class AddColorsConverter implements Converter
{
	public function convert($item)
	{
		$colorsArray = ['red', 'darkorange', 'yellow', 'green', 'deepskyblue', 'blue', 'blueviolet'];
		return '<p style="background-color: ' . $colorsArray[rand(0, 6)] . '">' . $item . '</p>' . PHP_EOL;
	}
}

class ToUpperConverter implements Converter
{
	public function convert($item)
	{
		return mb_strtoupper($item);
	}
}

$import = new Import;
$import->from(new FileReader('test1.html'))->to(new FileWriter('test3.html'))->execute();
$import->from(new FileReader('test1.html'))->to(new FileWriter('test2.html'))->with(new ToUpperConverter())->with(new AddColorsConverter())->execute();
