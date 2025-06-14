<?php

namespace App\Core;
use App\Core\Database;
/**
 * @Model
 */
class Model
{
	protected $database;
	protected $tableName;
	protected $fields;

	public function __construct() {
		$this->database = new Database();
	}
	public function index() {
		$arr = explode('\\', get_class($this));
		echo 'Echo from '.$arr[count($arr) - 1];
	}

	public function get($id) {
		$rowData = $this->database->select(implode(", ", $this->fields))
		->from($this->tableName)
		->where("id", "=", $id)
		->whereNull("id", false)
		->whereIn("id", array(1, 2, 3, 4, 5, 6))
		->getRow();
		return $rowData;
	}

	/**
	 * GetList resource by filter,eg. array('id' => 10)
	 */
	public function getList(array $filter) {
		$results = $this->database->select("id, name, language")
		->from("nationalities ")
		->whereIn("id", array(1, 2, 3, 4, 5, 6))
		->getResult();
		if ($results != null) {
			echo '<pre>';
			print_r($results);
			echo '</pre>';
		}
		return $results;
	}

	public function connectDatabase() {
		$this->database->connect();
	}
}