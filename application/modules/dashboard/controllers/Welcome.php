<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
		// $this->load->model('monitoring/Model_overall');
		// $this->r_dbdata = $this->accesscontrol->reader_db_read();	
	    if(empty($_SESSION['userdetail'])) { redirect( base_url('Login')); }
	}

	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->view('v_header');
		$this->load->view('welcome_message');
		$this->load->view('v_footer');
	}

	public function menu()
	{
		
		$this->load->view('v_header');
		$this->load->view('v_footer');
	}

}
