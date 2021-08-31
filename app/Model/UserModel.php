<?php
App::uses('AppModel', 'Model');

class UserModel extends AppModel {

	public $useTable = 'users';
	//public $components = array('Session');

	public function insertEmployee($firstname, $lastname, $username, $dofBirth, $gender, $marital, $phone, $email, $encrypt_pwd, $addr, $emp_id){

		$date = ('Y-m-d H:i:s');
		// $empid = $this->Session->read('EMPID');
		// pr($empid);die();
		$param = array();
		$sql = "";
		$sql .= "INSERT INTO users (firstname, lastname, username, dateofbirth, email, password, gender, marital_status, phone, address, flag, created_id, updated_id, created_date, updated_date)";
		$sql .= " VALUES (:firstname, :lastname, :username, :dateofbirth, :email, :password, :gender, :marital_status, :phone, :address, :flag, :created_id, :updated_id, :created_date, :updated_date)";

		$param['firstname'] = $firstname;
		$param['lastname'] = $lastname;
		$param['username'] = $username;
		$param['dateofbirth'] = $dofBirth;
		$param['email'] = $email;
		$param['password'] = $encrypt_pwd;
		$param['gender'] = $gender;
		$param['marital_status'] = $marital;
		$param['phone'] = $phone;
		$param['address'] = $addr;
		$param['flag'] = 1;
		$param['created_id'] = $emp_id;
		$param['updated_id'] = $emp_id;
		$param['created_date'] = $date;
		$param['updated_date'] = $date;

		$data = $this->query($sql, $param);
		return $data;
	}

	public function deleteEmpdata($empid){
		$param = array();
		$date = date('Y-m-d H:i:s');
		$sql = "";
		$sql .= "UPDATE users SET flag = :flag, updated_date = :updated_date";
		$sql .= " WHERE id = :id";

		$param['flag'] = 0;
		$param['updated_date'] = $date; 
		$param['id'] = $empid;
		$data = $this->query($sql, $param);
		return $data;
	}

	public function updateEmployee($empid, $firstname, $lastname, $username, $dofBirth, $gender, $marital, $phone, $email, $addr, $emp_id){

		$date = ('Y-m-d H:i:s');
		$param = array();
		$sql = "";
		$sql .= " UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username, dateofbirth = :dateofbirth, email = :email, gender = :gender, marital_status = :marital_status, phone = :phone, address = :address, flag = :flag, updated_id = :updated_id, updated_date = :updated_date";
		$sql .= " WHERE id = :id";

		$param['id'] = $empid;
		$param['firstname'] = $firstname;
		$param['lastname'] = $lastname;
		$param['username'] = $username;
		$param['dateofbirth'] = $dofBirth;
		$param['email'] = $email;
		$param['gender'] = $gender;
		$param['marital_status'] = $marital;
		$param['phone'] = $phone;
		$param['address'] = $addr;
		$param['flag'] = 1;
		$param['updated_id'] = $emp_id;
		$param['updated_date'] = $date;
		
		$data = $this->query($sql, $param);
		return $data;
	}
	
	public function getExportData($data){
		$param = array();
		$qryCond = '';

		if(isset($data['id'])){
			$qryCond .= ' AND EMP.id = :id';
			$param['id'] = $data['id'];
		}
		if(isset($data['username LIKE'])){
			$qryCond .= ' AND EMP.username LIKE :username';
			$param['username'] = $data['username LIKE'];
		}
		if(isset($data['email'])){
			$qryCond .= ' AND EMP.email = :email';
			$param['email'] = $data['email'];
		}

		$sql = '';
		$sql .= "SELECT * FROM users AS EMP ";
		$sql .= " WHERE flag = 1";
		$sql .= $qryCond;

		$result = $this->query($sql, $param);
		return $result;
	}
}
