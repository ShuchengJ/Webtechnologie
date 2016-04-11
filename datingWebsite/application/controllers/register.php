<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user','',TRUE);
	}
	
	function index()
	{
		
		$this->load->helper(array('form'));
		$data['loggedin'] = $this->session->userdata('logged_in');
		$this->load->view('header_view',$data);
		if(null == ($this->session->userdata('register_step'))){
			$this->session->set_userdata('register_step','1');
		}
		
		$step = $this->session->userdata('register_step');
		switch ($step){
			case 1: $this->load->view('register_view',$data); break;
			case 2: $this->load->view('register2_view',$this->generateQuestions()); break;
			case 3: $this->load->view('register3_view'); break;
			default: $this->session->set_userdata('register_step','1');
		}
	}
	
	function nextStep(){
		$stepNumber = $this->session->userdata('register_step');
		$this->session->set_userdata('register_step',$stepNumber + 1);
		redirect('register','auto');
	}
	
	function firstStep(){
		//TODO:: check input...
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
				'brands'=>$this->input->post('brands')
				);
		$this->session->set_userdata('userData',$userData);
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
		$this->user->register($userData);
		$this->user->login($userData['email'],$userData['password']);
		$this->session->set_userdata('logged_in',TRUE);
		$this->session->set_userdata('email',$userData['email']);
		redirect('home','auto');
	}
	
	function generateQuestions(){
		$returnArray = [
				'v1' => [
						'n'=>'1',
						'a'=>'1.50m',
						'b'=>'1.60m',
						'c'=>'deze vraag is racistisch.'],
				'v2' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v3' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v4' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v5' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v6' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v7' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v8' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v9' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v10' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v2' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
				'v2' => [
						'n'=>'2',
						'a'=>'1.90m',
						'b'=>'1.10m',
						'c'=>'bananen zijn krom.'],
		];
		//shuffle($returnArray);
		return $returnArray;
	}
	
	function calcPersonality($input){
		return array('q'=>'banaan',
					 'p'=>'kaas'
		);
	}
	
	
}
?>