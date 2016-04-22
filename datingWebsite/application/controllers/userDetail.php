<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserDetail extends CI_Controller {

	
	function __construct(){
		parent::__construct();
		$this->load->model('connections','',TRUE);
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
		if(null != $this->input->post('id')){
			$this->session->set_userdata('likedPage',$this->input->post('id'));
		}
		$profile = $this->session->userdata('likedPage');
		$wantedUser = $this->session->userdata('matches')[$profile];
		$this->session->set_userdata('match',$wantedUser);
		$this->load->view('Header_view',$data);
		$this->load->view('UserDetail_view',$wantedUser);

	}
	
	function like(){
		$currentUser = $this->session->userdata('profile')['email'];
		$likedUser = $this->session->userdata('match')['email'];
		$this->connections->addLike($currentUser,$likedUser);
		redirect('userDetail','local');
	}
}
?>