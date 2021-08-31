<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
	
	public $uses = array('User');
	
	public $components = array(
			'Flash',
			'Session',
			'Auth' => array(
					'logoutRedirect' => array(
							'controller' => 'Login',
							'action' => 'index'
					)
			)
	);

	public function beforeFilter() {
		$email = $this->Session->check('EMAIL');
		if(!$email){
			$this->redirect(array('controller' => 'Login', 'action' => 'index'));
			
		}
	}

	public function getErrorMsg(){
		
	}
	
}
