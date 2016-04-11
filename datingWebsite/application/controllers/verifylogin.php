<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->library('session');
	}
	
	function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
   		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		
   		if($this->form_validation->run() == FALSE){
   			$data = array('loggedin'=>FALSE);
   			$this->load->view('header_view',$data);
   			$this->load->view('login_view');
   		}
   		else
   		{
   			//Go to private area
   			//$this->load->view('login_view');
   			redirect(site_url('home'),'auto');
   		}
	}
	
	function check_database($password){
		$email = $this->input->post('email');
		$result = $this->user->login($email,$password);
		
		if($result){
			$sess_array = array();
			foreach($result as $row){
				//$sess_array = array('id' => $row ->id, 'email' => $row->email);
				$this->session->set_userdata('logged_in',TRUE);
				$this->session->set_userdata('email',$row->email);
			}
			return TRUE;
		}
		else{
			$this -> form_validation->set_message('check_database','Invalid email/password');
			return FALSE;
		}
	}
}
?>