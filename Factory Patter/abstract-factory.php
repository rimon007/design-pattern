<?php 

abstract class ProviderServicesFactory {
	abstract public function makeService($service);
}

class ProviderFactory extends ProviderServicesFactory {
	public function makeService($service) {
		$instance = ucfirst($service).'Repository';
		return new $instance;
	}
}

abstract class AbstractServices {
	abstract public function CreateCatalog();
	abstract public function EditCatalog();
	abstract public function ShowCatalog();
}

abstract class CommomServiceRepository extends AbstractServices {

	public $db;

	public function __construct() {
		$this->db = new DBQueryRepository;
	}

	public function OwnFunc() {
		var_dump('Common service in here.');
	}
}

class DBQueryRepository {

	protected $api;

	public function __construct() {
		$this->api = new ApiRepository;
	}

	public function getUser() {
		return ['Rimon', 'Karim', 'Rahim'];
	}

	public function getApi() {
		return $this->api->getApiCatagory();
	}
}

class ApiRepository {

	public function getApiCatagory() {
		return ['chaldal', 'agora', 'helloloundry'];
	}
}

class SaloonRepository extends CommomServiceRepository {


	public function CreateCatalog() {
		var_dump($this->db->getApi());
	}
	public function EditCatalog() {
		var_dump('Edit Catalog Service');
	}
	public function ShowCatalog() {
		var_dump('Show Catalog Service');
	}
}

class HotelRepository extends CommomServiceRepository {
	public function CreateCatalog() {
		var_dump('Create Catalog For Hotel');
	}
	public function EditCatalog() {
		var_dump('Edit Catalog For Hotel');
	}
	public function ShowCatalog() {
		var_dump('Show Catalog For Hotel');
	}
}

class CarRepairRepository extends CommomServiceRepository {
	public function CreateCatalog() {
		var_dump('Create Catalog For Car Repair');
	}
	public function EditCatalog() {
		var_dump('Edit Catalog For Car Repair');
	}
	public function ShowCatalog() {
		var_dump('Show Catalog For Car Repair');
	}
}

$factory = new ProviderFactory;

$saloon = $factory->makeService('saloon');

$saloon->OwnFunc();
$saloon->CreateCatalog();
$saloon->EditCatalog();
$saloon->ShowCatalog();