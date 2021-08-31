<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public $uses = array('UserModel');
	public $components = array('Paginator', 'PhpExcel.PhpExcel');
	var $helpers = array ('Html', 'Form');
	
	public function index() {

		$errorMsg = "";
		$successMsg = "";
		$errMsg = "";
		$succMsg = "";

		$conditions = [];
		$conditions['flag'] = 1;
		$this->paginate = array(
			'limit' => 7,
			'conditions' => $conditions
		);
		$list = $this->Paginator->paginate();
		$pageCount = $this->params['paging']['UserModel']['pageCount'];
		$rowCount = $this->params['paging']['UserModel']['count'];

		if($rowCount > 0){
			$successMsg = "Total Row: $rowCount Row";
		}else{
			$errorMsg = "Data is not found!";
		}

		$this->set("errorMsg", $errorMsg);
		$this->set("successMsg", $successMsg);
		$this->set("errMsg", $errMsg);
		$this->set("succMsg", $succMsg);
		$this->set('users', $list);
		$this->set('pageCount', $pageCount);
	}

	public function search() {
		$errorMsg = "";
		$successMsg = "";
		$errMsg = "";
		$succMsg = "";

		$conditions = [];
		$search = [];
		
		if($this->Session->check('Employees_successMsg')){
			$succMsg = $this->Session->read('Employees_successMsg');
			$this->Session->delete('Employees_successMsg');
			}else{
			$this->set('succMsg','');
			}

			if($this->Session->check('Employees_errorMsg')){
			$errMsg = $this->Session->read('Employees_errorMsg');
			$this->Session->delete('Employees_errorMsg');
			}else{
			$this->set('errMsg','');
			}

		if($this->request->is('post')) {
			$id = $this->request->data['emp_id'];
			$name = $this->request->data['username'];
			$email = $this->request->data['email'];

			$this->Session->write('ID',$id);
			$this->Session->write('NAME',$name);
			$this->Session->write('EMAIL',$email);


			}if($this->request->is('get')) {
			$id = $this->Session->read('ID');
			$name =$this->Session->read('NAME');
			$email=$this->Session->read('EMAIL');
			}

			if(!empty($id)) {
			$conditions['id'] = $id;
			}
			if(!empty($name)) {
			$conditions['username LIKE '] = '%'.$name.'%';
			}
			if(!empty($email)) {
			$conditions['email'] = $email;
			}

			$search = array(
			'id' => $id,
			'username' => $name,
			'email' => $email
			);

		$conditions['flag'] = 1;
		$this->paginate = array(
			'limit' => 7,
			'conditions' => $conditions
		);
		$list = $this->Paginator->paginate();
		$pageCount = $this->params['paging']['UserModel']['pageCount'];
		$rowCount = $this->params['paging']['UserModel']['count'];
		if($rowCount > 0){
			$successMsg = "Total Row: $rowCount Row";
		}else{
			$errorMsg = "Data is not found!";
		}

		$this->set("errorMsg", $errorMsg);
		$this->set("successMsg", $successMsg);
		$this->set("errMsg", $errMsg);
		$this->set("succMsg", $succMsg);
		$this->set('users', $list);
		$this->set('pageCount', $pageCount);
		$this->set('search', $search);
		$this->render('index');
	}

	public function autoFill() {
		$this->request->allowMethod('ajax');
		$this->autoRender = false;
		$this->layout = false;

		$name = $this->request->query('q');
		$id = $this->request->data('id');
		// pr($name);
		$get = $this->UserModel->find('first', array(
				'conditions' => array(
					'flag' => 1,
					'id' => $id,
					'username LIKE' => '%'.$name.'%'
				),
				'fields' => array(
					'id',
					'username',
					'email'
				)
			)
		);
		// debug($this->Employee->getDataSource()->getLog());
		// pr($get);
		echo json_encode($get);
	}

	public function edit(){
		if($this->request->is('post')){
			$editId=$this->request->data("hdId");

			$this->Session->write('EditEMPID', $editId);
			$this->redirect(array('controller'=>'Registration', 'action'=>'Upload'));
		}
	}

	public function delete(){
		$errorMsg = "";
		$successMsg = "";
		$errMsg = "";
		$succMsg = "";
		if($this->request->is('post')){
			$deleteId=$this->request->data("hdId");
			$this->UserModel->deleteEmpdata($deleteId);
			// $this->Session->write('Employee_successMsg', "Delete Successfully!");
			// $this->redirect(array('action'=>'search'));  //refresh function
			// $errMsg = "Delete successfully!";
			// $this->set("errorMsg", $errorMsg);
			// $this->set("successMsg", $successMsg);
			// $this->set("errMsg", $errMsg);
			// $this->set("succMsg", $succMsg);
			// $this->set('pageCount', $pageCount);
			$this->redirect(array('action' => 'index'));
		}
	}

	public function viewer(){
		
		$this->request->allowMethod('ajax');
		$this->autoRender = false;
		$this->layout = false;
		
		$id = $this->request->data('id');

		$get = $this->UserModel->find('first', array(
				'conditions' => array(
					'flag' => 1,
					'id' => $id
				),
				'fields' => array(
					'id',
					'firstname',
					'lastname',
					'username',
					'dateofbirth',
					'email',
					'gender',
					'marital_status',
					'phone',
					'address'
				)
			)
		);
		echo json_encode($get);
	}

	public function exportCSV(){
		
		if($this->request->is('post')){
			$csv_id=$this->request->data("csv_excel");

			$emp_data = $this->UserModel->find(
											'all',
												array('conditions'=>
													array(
														'flag !=' => 0 
													)
												)
											);
			// pr($emp_data);die();
			// pr(count($emp_data));die();
			$countEmpdata = count($emp_data);

			if($countEmpdata == 0){
				$errorMsg = "There is no data to export!";
				$this->Flash->set($errorMsg, array('key'=> 'errorMessage'));
				// $this->Session->write('ErrorMsg', "Your data is not found!");
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->set('page', $emp_data);
			}
			$this->layout = false;
			$this->render('usercsv');
		}
	}

	public function ExportExel(){
		$errorMsg = "";
		$successMsg = "";
		$errMsg = "";
		$succMsg = "";

		$data = array();

		$this->layout = null;
		$this->autoLayout = false;
		Configure::write ('debug', '2');

		if($this->request->is('post')){
			$id = $this->request->data['emp_id'];
			$username = $this->request->data['username'];
			$email = $this->request->data['email'];
			if(!empty($id)) {
				$data['id'] = $id;
			}
			if(!empty($username)) {
				$data['username LIKE'] = '%'.$username.'%';
			}
			if(!empty($email)) {
				$data['email'] = $email;
			}
		}
		$employee_data = $this->UserModel->getExportData($data);
		//pr($employee_data);die();

		/** Format Excel Worksheet Start **/
		if(!empty($employee_data)){
			$objWorkSheetWorkSheet = $this->PhpExcel->createWorksheet()->setDefaultFont('Times New Roman', 12);
			$objWorkSheetWorkSheet ->getActiveSheet ()->getPageSetup ()->setOrientation (PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
			$objWorkSheetWorkSheet ->getActiveSheet ()->getPageSetup ()->setPaperSize (PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
			$objWorkSheetWorkSheet ->getActiveSheet ()->getPageSetup ()->setFitToWidth ( 1 );
			$objWorkSheetWorkSheet ->getActiveSheet()->setShowGridlines(false);
			
			$sheet = $this->PhpExcel->getActiveSheet();
		
			$styleArray = array(
					'font'  => array(
							'bold'  => true,
							'size'  => 20,
							'name'  => 'Arial Black'
					),
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
					));
			$headerstyle = array(
					'font'  => array(
							'size'  => 14
							
					));
			$textStyle = array(
					'font'  => array(
							'size'  => 18
							
					));
			$alignStyle = array (
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
					));
			$bottom = array(
					'borders' => array(
							'bottom' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
							)
					));
			$aligncenter = array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
					),
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN)
					));
			
			
			
			$sheet->getStyle('A1:L1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$sheet->getStyle('A1:L1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('66CDAA');
			$sheet->getStyle("B1:L1")->applyFromArray($aligncenter);
			$sheet->getStyle("A1:L1")->applyFromArray($headerstyle);
			
			$sheet->mergeCells('I1:J1');
			
			$sheet->getColumnDimension('A')->setWidth(5);
			$sheet->getColumnDimension('B')->setWidth(15);
			$sheet->getColumnDimension('C')->setWidth(20);
			$sheet->getColumnDimension('D')->setWidth(20);
			$sheet->getColumnDimension("E")->setWidth(30);
			$sheet->getColumnDimension("F")->setWidth(30);
			$sheet->getColumnDimension("G")->setWidth(20);
			$sheet->getColumnDimension("H")->setWidth(20);
			$sheet->getColumnDimension("I")->setWidth(20);
			$sheet->getColumnDimension("J")->setWidth(20);
			$sheet->getColumnDimension("K")->setWidth(20);
			$sheet->getColumnDimension("L")->setWidth(30);
			 	
			$sheet->setCellValue('A1',' No.');
			$sheet->setCellValue('B1',' Employee_ID');
			$sheet->setCellValue('C1',' First_Name');
			$sheet->setCellValue('D1',' Last_Name');
			$sheet->setCellValue('E1',' Username');
			$sheet->setCellValue('F1',' Date_of_Birth');
			$sheet->setCellValue('G1',' Gender'); 
			$sheet->setCellValue('H1',' Marital_Status');
			$sheet->setCellValue('I1',' Email');
			$sheet->setCellValue('K1',' Phone');
			$sheet->setCellValue('L1',' Address');
			//end declare title in excel

			$num = 1;
			$row = 2;
			foreach($employee_data as $key=>$value){
				//pr($value);die();
				$emp_id=$value['EMP']['id'];
				$emp_Fname=$value['EMP']['firstname'];
				$emp_Lname=$value['EMP']['lastname'];
				$emp_name=$value['EMP']['username'];
				$dofbirth=$value['EMP']['dateofbirth'];
				$gender=$value['EMP']['gender'];
				$marital=$value['EMP']['marital_status'];
				$email=$value['EMP']['email'];
				$phone=$value['EMP']['phone'];
				$address=$value['EMP']['address'];
				
				
				$sheet->setCellValue('A'.$row, $num);
				$sheet->setCellValue('B'.$row, $emp_id);
				$sheet->setCellValue('C'.$row, $emp_Fname);
				$sheet->setCellValue('D'.$row, $emp_Lname);
				$sheet->setCellValue('E'.$row, $emp_name);
				$sheet->setCellValue('F'.$row, $dofbirth);
				$sheet->setCellValue('G'.$row, $gender);
				$sheet->setCellValue('H'.$row, $marital);
				$sheet->setCellValue('I'.$row, $email);
				$sheet->setCellValue('K'.$row, $phone);
				$sheet->setCellValue('L'.$row, $address);
				
				$row++;
				$num++;
			}
			$row=--$row;
			
			$sheet->getStyle("B2:B".$row)->applyFromArray($aligncenter);
			$sheet->getStyle("F2:F".$row)->applyFromArray($aligncenter);
			$sheet->getStyle("G2:G".$row)->applyFromArray($aligncenter);
			$sheet->getStyle("H2:H".$row)->applyFromArray($aligncenter);	
			$sheet->getStyle('A2:L'.$row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			$this->PhpExcel->output('EmployeeList.xlsx');
			$this->render('index');
		}else{
		
			$errorMsg="No data to export in Employee List!!";
			
			
			$this->Session->write("Employees_errorMsg", $errorMsg);
		
			$this->redirect('search');
		}
	}

	public function Print(){
		$errorMsg = "";
		$successMsg = "";
		$errMsg = "";
		$succMsg = "";

		if($this->request->is('post')){
			
			$emp_data = $this->UserModel->find(
											'all',
												array('conditions'=>
													array(
														'flag !=' => 0 
													)
												)
											);
			// pr($emp_data);die();

			if(!empty('$emp_data')){
				$this->set('users', $emp_data);
				
			}else{
				$errorMsg = "Data not found!";
				$this->set("errMsg", "$errorMsg");
			}
			$this->render("/Pdf/emplistpdf");
		}
	}
}