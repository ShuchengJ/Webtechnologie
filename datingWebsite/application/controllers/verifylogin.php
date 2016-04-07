<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user','',TRUE);
	}
	
	function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
   		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		
   		if($this->form_validation->run() == FALSE){
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
		$username = $this->input->post('username');
		$result = $this->user->login($username,$password);
		
		if($result){
			$sess_array = array();
			foreach($result as $row){
				$sess_array = array('id' => $row ->id, 'username' => $row->username);
				$this->session->set_userdata('logged_in',$sess_array);
			}
			return TRUE;
		}
		else{
			$this -> form_validation->set_message('check_database','Invalid username/password');
			return FALSE;
		}
	}
}
?>