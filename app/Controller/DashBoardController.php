<?php
App::uses('AppController', 'Controller');
/**
 * DashBoard Controller
 *
 */
class DashBoardController extends AppController {
	
	/**
	 * BeforeFilter Function
	 *
	 * @param NULL
	 */	
	function beforeFilter() {
		parent::beforeFilter();
	}

	public function index(){
		$this->render('index');
	}
	
}