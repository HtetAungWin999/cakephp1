<?php
App:: import("Vendor", "mypdf");
$this->layout = false;
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf -> setPrintHeader(false);
$pdf -> setPrintFooter(false);

$pdf -> setTopMargin(23);
$pdf -> setLeftMargin(18);
$pdf -> setRightMargin(18);

$pdf -> AddPage();

$html = "";
$html = '
	<style>
		.table {
			border-collapse: collapse;
		}
		th{
			text-align: center;
		}
		table, th, td {
  			border: 1px solid black;
		}
		.top_table{
			background-color: #82E0AA;
		}
		tr:hover {background-color: #F9E79F;}
	</style>
	';
$html .= '<body>';
$html .= '<img  src="img/header.png" class="left" height="200px"/>';
$html .= '<h1 style="text-align: center;"> Employee List </h1>';
$html .= '<table cellpadding="8" class = "table">';
$html .= '<tbody>';
$html .= '<tr class = "top_table">';
$html .= '<th width = "6%" >No</th>';
$html .= '<th width = "14%" >Username</th>';
$html .= '<th width = "12%" >Date of Birth</th>';
$html .= '<th width = "10%" >Gender</th>';
$html .= '<th width = "12%" >Marital Status</th>';
$html .= '<th width = "22%" >Email</th>';
$html .= '<th width = "14%" >Phone</th>';
$html .= '<th width = "20%" >Address</th>';
$html .= '</tr>';
// pr($users);die();
foreach ($users as $user){
	$id = $user['UserModel']['id'];
	$username = $user['UserModel']['username'];
	$dateofbirth = $user['UserModel']['dateofbirth'];
	$gender = $user['UserModel']['gender'];
	$marital = $user['UserModel']['marital_status'];
	$email = $user['UserModel']['email'];
	$phone = $user['UserModel']['phone'];
	$address = $user['UserModel']['address'];

 	if($user["UserModel"]["gender"] == "M"){
		$gender = "Male";
	}else{
		$gender = "Female";
	}
	if($user["UserModel"]["marital_status"] == "1"){
		$marital = "Single";
	}else if($user["UserModel"]["marital_status"] == "2"){
		$marital = "Relationship";
	}else{
		$marital = "Maried";
	}

	$html .= '<tr>';
	$html .= '<td>'.$id.'</td>';
	$html .= '<td>'.$username.'</td>';
	$html .= '<td>'.$dateofbirth.'</td>';
	$html .= '<td>'.$gender.'</td>';
	$html .= '<td>'.$marital.'</td>';
	$html .= '<td>'.$email.'</td>';
	$html .= '<td>'.$phone.'</td>';
	$html .= '<td>'.$address.'</td>';
	$html .= '</tr>';
}
$html .= '<br><br>';
$html .= 'KBZ Bank';
$html .= '<br>YGN92 (MYANMAR CENTER) BRANCH';
$html .= '<br>ACCOUNT NO: 123456765';
$html .= '<br>NAME: BRYCEN MYANMAR Co.,LTD';
$html .= '</tbody>';
$html .= '</table>';
$html .= '</body>';
$pdf->setFont("cid0jp", "",7);
$pdf->writeHTML($html, true, false, true, false, '');

ob_end_clean();

$date = date('dMyHi');
$file_name = 'EMP_'.$date.'.pdf';
$folder_path = WWW_ROOT. 'files'.DS.'pdf'.DS.'employee_list_PDF';

$ans = $pdf->IncludeJS("print();"); //print output
echo $pdf->Output($folder_path.DS.$file_name, 'FI'); //output file(webroot\files\pdf\employee_list_PDF) 
//unlink($folder_path.DS.$file_name); //delete download file