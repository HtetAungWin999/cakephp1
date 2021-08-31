<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 */
class Employee extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'employee';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public function insertEmployee($name, $email, $encrypt_pwd, $addr){
		$date = ('Y-m-d H:i:s');
		$param = array();
		$sql = "";
		$sql .= "INSERT INTO employee (name, email, password, address, flag, created_date, updated_date)";
		$sql .= " VALUES (:name, :email, :password, :address, :flag, :created_date, :updated_date)";

		$param['name'] = $name;
		$param['email'] = $email;
		$param['password'] = $encrypt_pwd;
		$param['address'] = $addr;
		$param['flag'] = 1;
		$param['created_date'] = $date;
		$param['updated_date'] = $date;

		$data = $this->query($sql, $param);
		return $data;
	}

	public function updateEmployee($empid, $name, $email, $addr){
		$date = ('Y-m-d H:i:s');
		$param = array();
		$sql = "";
		$sql .= "UPDATE employee SET name=:name, email=:email, address=:address,updated_date=:updated_date";
		$sql .= " WHERE id =:id";

		$param['id'] = $empid;
		$param['name'] = $name;
		$param['email'] = $email;
		$param['address'] = $addr;
		$param['updated_date'] = $date;

		$data = $this->query($sql, $param);
		return $data;
	}

	public function deleteEmpdata($empid){
		$param = array();
		$date = date('Y-m-d H:i:s');
		$sql = "";
		$sql .= "UPDATE employee SET flag = :flag, updated_date = :updated_date";
		$sql .= " WHERE id = :id";

		$param['flag'] = 0;
		$param['updated_date'] = $date; 
		$param['id'] = $empid;
		$data = $this->query($sql, $param);
		return $data;
	}

}
