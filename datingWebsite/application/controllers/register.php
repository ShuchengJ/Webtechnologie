<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	function index()
	{
		$this->load->helper(array('form'));
		$data['poep'] = $this->session->userdata('logged_in');
		$this->load->view('register_view',$data);
		
	}
	
	
}
?>