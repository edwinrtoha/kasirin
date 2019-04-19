<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kasir extends MX_Controller {
    public function __construct() {
        $this->CI =& get_instance();
    }
	public function index() {
        $this->load->view("kasir");
    }
}