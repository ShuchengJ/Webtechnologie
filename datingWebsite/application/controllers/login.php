<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	function index()
	{
		if($this -> session -> userdata('logged_in')){
			$data['loggedin'] = $this->session->userdata('logged_in');
			$data['email'] = $this->session->userdata('email');
				
		}else{
			$data['loggedin'] = FALSE;
		}
		
		$this->load->database();
		$this->load->helper(array('form'));
		$this->load->view('Header_view',$data);
		$this->load->view('Login_view');
	}
}
?>