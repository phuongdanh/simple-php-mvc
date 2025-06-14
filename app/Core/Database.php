<?php
namespace App\Core;
use App\Core\Process\MyException;
class Database {

    protected $db;
    protected $scriptFinal;
    protected $scriptSelect;
    protected $scriptFrom;
    protected $scriptWhere;

    public function __construct() {
        $this->connect();
        $this->resetScript();
    }

    public function __destruct() {
        $this->resetScript();
        $this->disConnect();
    }

    public function connect() {
        // try {
        //     $this->db = new \PDO('mysql:host=localhost;dbname=recruit', 'root', '');
        //     return $this->db;
        // } catch (PDOException $e) {
        //     echo 'Connection failed: ' . $e->getMessage();
        // }
    }

    public function resetScript() {
        $this->scriptFinal = '[[SELECT_SCRIPT]] [[FROM_SCRIPT]] [[WHERE_SCRIPT]]';
        $this->scriptSelect = '';
        $this->scriptFrom = '';
        $this->scriptWhere = 'WHERE 1';
    }


    public function select(string $fields) {
        if (trim($fields) !== '*') {
            $fieldsEx = array_map(function ($field) {
                return "`".trim($field)."`";
            }, explode(",", $fields));
            $fields = implode(",", $fieldsEx);
        }
        $this->scriptSelect = "SELECT $fields";
        return $this;
    }

    public function from(string $tableName) {
        $this->scriptFrom = "FROM `". trim($tableName) ."`";
        return $this;
    }

    public function whereArray(array $conditions = array()) {
        foreach ($conditions as $field => $value) {
            $this->where($field, "=", $value);
        }
        return $this;
    }

    /**
    * Group comparison condition
    */
    public function where(string $field, string $operator, $value) {
        $this->scriptWhere .= " AND `". trim($field) ."` ". trim($operator) ."'". $value ."'";
        return $this;
    }

    public function whereIn(string $field, array $values, bool $isIn = true) {
        $this->scriptWhere .= " AND `". trim($field) ."`";
        if ($isIn === false) {
            $this->scriptWhere .= " NOT";
        }
        $this->scriptWhere .= " IN ('". implode("','", $values) ."')";
        return $this;
    }

    public function whereNull(string $field, bool $isNull = true) {
        $this->scriptWhere .= " AND `". trim($field) ."` IS";
        if ($isNull === false) {
            $this->scriptWhere .= " NOT";
        }
        $this->scriptWhere .= " NULL";
        return $this;
    }

    public function whereLike(string $field, string $value) {
        $this->scriptWhere .= " AND `". trim($field) ."` LIKE '". $value ."'";
        return $this;
    }

    public function whereExist(string $field) {

    }

    /**
     * getRow of particular table name and with give condidtion conditions
     * @param string tableName
     * @param array conditions eg. array('id' => 1, 'status' => 'ACTIVE')
     * @param array data return first matched record
     */
    public function getRow(string $tableName = null, array $conditions = array()) {
        if ($tableName !== null) {
            $this->from($tableName);
        }
        $this->initFinalScript();
        $stmt = $this->db->prepare($this->scriptFinal);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_NAMED);
        $this->resetScript();
        return $row;
    }

    public function getResult(string $tableName = null, array $conditions = array()) {
        if ($tableName !== null) {
            $this->from($tableName);
        }
        $this->initFinalScript();
        $stmt = $this->db->prepare($this->scriptFinal);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_NAMED);
        $this->resetScript();
        return $result;
    }


    public function insert(string $tableName, array $row) {
        if ($row != null) {
            $fieldName = array_keys($row);
            $fieldKey = implode(", ", $fieldName);
            $fieldKeyVar = implode(", ", array_map( function ($key) { return ":$key"; }, $fieldName));
            $stmt = $this->db->prepare("INSERT INTO $tableName ($fieldKey) VALUES ($fieldKeyVar)");
            foreach ($row as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            try {
                $stmt->execute();
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            throw new MyException("Data can not be null");
        }
    }

    public function update() {

    }

    public function delete() {

    }

    public function disConnect() {
        $this->db = null;
    }

    protected function initFinalScript() {
        $this->scriptFinal = str_replace('[[SELECT_SCRIPT]]', $this->scriptSelect, $this->scriptFinal);
        $this->scriptFinal = str_replace('[[FROM_SCRIPT]]', $this->scriptFrom, $this->scriptFinal);
        $this->scriptFinal = str_replace('[[WHERE_SCRIPT]]', $this->scriptWhere, $this->scriptFinal);
    }
}