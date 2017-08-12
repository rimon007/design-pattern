<?php 


class CarFactory {
	protected $brands = [];

	public function __construct() {
		$this->brands = [
			'mercedes' => 'MercedesCar',
			'toyota' => 'ToyotaCar'
		];
	}


	public function make($brand) {
		if(!array_key_exists($brand, $this->brands))
			throw new Exception('Not available this car');

		$classname = $this->brands[$brand];

		return new $classname;
	}
}

interface CarInterface {
	public function design();
	public function assemble();
	public function print();
}

class MercedesCar implements CarInterface {
	public function design() {
		var_dump('Design for mercedes car');
	}

	public function assemble() {
		var_dump('Assemble for mercedes Car');
	}

	public function print() {
		var_dump('Print for mercedes car');
	}
}

class ToyotaCar implements CarInterface {
	public function design() {
		var_dump('Design for Toyota car');
	}

	public function assemble() {
		var_dump('Assemble for Toyota Car');
	}

	public function print() {
		var_dump('Print for Toyota car');
	}
}

$factory = new CarFactory;
$factory = $factory->make('toyota');

$factory->design();
$factory->assemble();
$factory->print();