<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		 
		$this->load->view('header_view',$data);
		$this->load->view('profile_view',$data);
		
		
	}
	
	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home','refresh');
	}
}
