<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserDetail extends CI_Controller {

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
		$profile = $this->input->post('id');
		$wantedUser = $this->session->get_userdata('matches')['matches'][$profile];
		echo var_dump($wantedUser);
		$this->load->view('userDetail_view',$wantedUser);
	}
}
?>