<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	function index()
	{	
		if($this -> session -> userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['loggedin'] = TRUE;
			
		}else{
			$data['loggedin'] = FALSE;
		}
		 
		$this->load->view('home_view',$data);
		
		
	}
	
	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home','refresh');
	}
}
