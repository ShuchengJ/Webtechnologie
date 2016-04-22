<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->model('connections','',TRUE);
		$this->load->library('session');
	}
	
	function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
   		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		
   		if($this->form_validation->run() == FALSE){
   			$data = array('loggedin'=>FALSE);
   			$this->load->view('Header_view',$data);
   			$this->load->view('Login_view');
   		}
   		else
   		{
   			$profile = $this->user->getUserInformation($this->input->post('email')); //TODO:: this should be PK ID
   			$currentUser = $this->session->userdata('profile')['email'];
			$this->session->set_userdata('profile',$profile);
			$this->session->set_userdata('like',$this->connections->getLikeInformation($currentUser));
			echo var_dump($this->session->userdata('like'));
   			//redirect(site_url('home'),'auto');
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