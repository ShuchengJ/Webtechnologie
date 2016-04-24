<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user','',TRUE);
	}
	
	function index()
	{
		if($this -> session -> userdata('logged_in')){
			$data['loggedin'] = $this->session->userdata('logged_in');
			$data['email'] = $this->session->userdata('email');
			$data['admin'] = $this->session->userdata('admin');
		}else{
			redirect('Login','auto');
		}
		$this->load->view('Header_view',$data);
		$this->load->view('Configuration_view');
	}
	
	function submit()
	{
		$values = array(
				'brands'=>$this->input->post('brands'),
				'x'=>$this->input->post('x'),
				'alpha'=>$this->input->post('alpha'));
		$this->user->change($values);
		redirect('Home',auto);
	}
}
?>