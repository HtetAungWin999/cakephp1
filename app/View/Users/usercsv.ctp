<?php 
// pr($page);die();

	$head = array("ID", "Name", "Date of Birth", "Gender", "Marital Status", "Email", "Phone", "Address");
	$this->CSV->addRow($head);

	foreach ($page as $value) {

		$ID = "=\"".$value['UserModel']['id']."\"";
		$Name = "=\"".$value['UserModel']['username']."\"";
		$dateofbirth = "=\"".$value['UserModel']['dateofbirth']."\"";
		$gender = "=\"".$value['UserModel']['gender']."\"";
		$marital = "=\"".$value['UserModel']['marital_status']."\"";
		$Email = "=\"".$value['UserModel']['email']."\"";
		$phone = "=\"".$value['UserModel']['phone']."\"";
		$Address = "=\"".$value['UserModel']['address']."\"";
		// $dd = "\"Hello\"";
		$this->CSV->addField($ID);
		$this->CSV->addField($Name);
		$this->CSV->addField($dateofbirth);
		$this->CSV->addField($gender);
		$this->CSV->addField($marital);
		$this->CSV->addField($Email);
		$this->CSV->addField($phone);
		$this->CSV->addField($Address);

		$this->CSV->endRow(); //linebreak
	}
	$filename = 'employees';

	echo $this->CSV->render($filename);

 ?>