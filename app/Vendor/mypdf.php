<?php
// session_start();
App::import('Vendor','tcpdf/tcpdf');

class MYPDF extends TCPDF {

	public function Header() {
		$header = $_SESSION['PDF_CUST_HEADER'];
		if ($header == 'default_header') {
			$orientation = $_SESSION['PDF_CUST_ORIENTIATION'];
			$this->default_Header($orientation);
		} else if ($header == 'simple_header') {
			$title = $_SESSION['PDF_CUST_TITLE'];
			$this->simple_header($title);
		} else if ($header == 'jp_header') {
			$this->JP_Order_header();
		}
	}
	

	public function Footer() {
		// Position at 10 mm from bottom
        $this->SetY(-13);
        // Set font
        $this->SetFont('cid0jp', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');	
	}
}


?>