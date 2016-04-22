<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user','',TRUE);
		$this->load->model('connections','',TRUE);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
	}
	
	function index()
	{
		
		$this->load->helper(array('form'));
		$data['loggedin'] = $this->session->userdata('logged_in');
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
				$this->load->view('Register3_view',$personality); break;
			default: $this->session->set_userdata('register_step','1');
		}
	}
	
	function nextStep(){
		if($this->session->userdata('error')['error'])
			redirect('register','auto');
		$stepNumber = $this->session->userdata('register_step');
		$this->session->set_userdata('register_step',$stepNumber + 1);
		redirect('register','auto');
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
		$userData['wanted'] = array('ei'=>100 - $userData['personality']['ei'],
				'ns'=>100 - $userData['personality']['ns'],
				'tf'=>100 - $userData['personality']['tf'],
				'jp'=>100 - $userData['personality']['jp']);
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