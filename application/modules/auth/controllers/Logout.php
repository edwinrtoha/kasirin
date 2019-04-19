<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends MX_Controller {
	public function index() {
		$this->Auth_model->logout();
	}
}