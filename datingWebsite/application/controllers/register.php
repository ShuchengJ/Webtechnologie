<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user','',TRUE);
		$this->load->model('connections','',TRUE);
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');

	}
	
	function index()
	{
		$this->load->helper(array('form'));
		$data['loggedin'] = $this->session->userdata('logged_in');
		$data['admin'] = $this->session->userdata('admin');
		$this->load->view('Header_view',$data);
		if(null == ($this->session->userdata('register_step'))){
			$this->session->set_userdata('register_step','1');
			$this->session->set_userdata('error',array('error'=>false));
		}
		
		$step = $this->session->userdata('register_step');
		switch ($step){
			case 1: $error = $this->session->userdata('error'); 
				$this->load->view('Register_view',$error); break;
			case 2: $this->load->view('Register2_view',$this->generateQuestions()); break;
			case 3: $personality = $this->session->userdata('userData')['personality'];
				$data = array('personality'=>$personality,'error'=>$this->session->userdata('error'));
				$this->load->view('Register3_view',$data); break;
			default: $this->session->set_userdata('register_step','1');
		}
	}
	
	function nextStep(){
		if($this->session->userdata('error')['error'])
			redirect('Register','auto');
		$stepNumber = $this->session->userdata('register_step');
		$this->session->set_userdata('register_step',$stepNumber + 1);
		redirect('Register','auto');
	}
	
	function firstStep(){
		$userData = array(
				'nickname'=>$this->input->post('nickname'),
				'fullname'=>$this->input->post('fullname'),
				'email'=>$this->input->post('email'),
				'password'=>$this->input->post('password'),
				'day'=>$this->input->post('day'),
				'month'=>$this->input->post('month'),
				'year'=>$this->input->post('year'),
				'gender'=>$this->input->post('gender'),
				'interest'=>$this->input->post('interest'),
				'age'=>$this->input->post('age'),
				'brands'=>$this->input->post('brands'),
				'description'=>$this->input->post('description')
				);
		
		if ($this->form_validation->run()){
			$this->session->set_userdata('error',array('error'=>false));
			$this->session->set_userdata('userData',$userData);
		}
		else 
			$this->session->set_userdata('error',array('error'=>true));
		$this->nextStep();
		
	}
	
	function secondStep(){
		$pers = $this->calcPersonality($this->input->post());
		$data = $this->session->userdata('userData');
		$data['personality'] = $pers;
		$this->session->set_userdata('userData',$data);
		$this->nextStep();
	}
	
	function thirdStep(){
		$userData = $this->session->userdata('userData');
		$config['upload_path'] = './';
		$config['file_name'] = $userData['email'].".png";
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '20480';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload())
		{
			if($_FILES['userfile']['error'] != 4)
			{
				$this->session->set_userdata('error',array('error'=>true,'errortext'=>$this->upload->display_errors()));
				redirect('Register','auto');
			}
		}
		$this->session->set_userdata('error',array('error'=>false));
		$this->session->set_userdata('admin',FALSE);
		
		$userData['wanted'] = array('ei'=>$this->input->post('PersonEI'),
				'ns'=>$this->input->post('PersonNS'),
				'tf'=>$this->input->post('PersonFT'),
				'jp'=>$this->input->post('PersonJP'));
		$this->session->set_userdata('userData',$userData);
		$this->user->register($userData);
		$this->connections->register($userData);
		$this->user->login($userData['email'],$userData['password']);
		$this->session->set_userdata('logged_in',TRUE);
		$this->session->set_userdata('email',$userData['email']);
		redirect('home','auto');
	}
	
	function generateQuestions(){
		$file = fopen(FCPATH.'questions.txt','r');
		while ($line = fgets($file)) {
			$line = substr($line, 0 , -2);
			$returnArray[$line] = ['n' => fgets($file),
		'a' => fgets($file), 'b' => fgets($file), 'c'=> fgets($file)];
		}
		fclose($file);
		return $returnArray;
	}
	
	function calcPersonality($input){
		$ei = 50;
		$ns = 50;
		$tf = 50;
		$jp = 50;
		for ($x = 1; $x < 6; $x++) {
			$question = "v".$x;
			$answer = $input[$question];
			if($answer == "a")
				$ei += 10;
			elseif ($answer == "b")
				$ei -= 10;
		}
		for ($x = 6; $x < 10; $x++) {
			$question = "v".$x;
			$answer = $input[$question];
			if($answer == "a")
				$ns += 12.5;
			elseif ($answer == "b")
			$ns -= 12.5;
		}
		for ($x = 10; $x < 14; $x++) {
			$question = "v".$x;
			$answer = $input[$question];
			if($answer == "a")
				$tf += 12.5;
			elseif ($answer == "b")
				$tf -= 12.5;
		}
		for ($x = 14; $x < 20; $x++) {
			$question = "v".$x;
			$answer = $input[$question];
			if($answer == "a")
				$jp += 8.3333333333333;
			elseif ($answer == "b")
				$jp -= 8.3333333333333;
		}
		return array('ei'=>$ei,
					 'ns'=>$ns,
					 'tf'=>$tf,
					 'jp'=>$jp
		);
	}
}
?>