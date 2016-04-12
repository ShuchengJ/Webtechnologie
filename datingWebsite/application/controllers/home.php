<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
			
		}else{
			$data['loggedin'] = FALSE;
		}
		
		$this->load->view('header_view',$data);
		$this->load->view('home_view',$data);
		
		
	}
	
	function match_get(){
		
		$profiles = $this->user->getRandomMatch();
		for ($x = 0; $x < count($profiles); $x++) {
			$age = $this->getAge($profiles[$x]['year'],$profiles[$x]['month'],$profiles[$x]['day']);
			$data[$x] = array('nickname'=>$profiles[$x]['nickname'],
							  'gender'=>$profiles[$x]['gender'],
							  'id'=>$profiles[$x]['id'],
							  'age'=>$age,
							  'image'=>'none'
			);
		}
		$this->session->set_userdata('matches',$profiles);
		echo json_encode($data);
	}
	
	function search(){
		$gender = $this->input->post("gender");
		$profiles = $this->user->getSearchedMatch($gender);
		for ($x = 0; $x < count($profiles); $x++) {
			$age = $this->getAge($profiles[$x]['year'],$profiles[$x]['month'],$profiles[$x]['day']);
			$data[$x] = array('nickname'=>$profiles[$x]['nickname'],
							  'gender'=>$profiles[$x]['gender'],
							  'id'=>$profiles[$x]['id'],
							  'age'=>$age,
							  'image'=>'none'
			);
		}
		$this->session->set_userdata('matches',$profiles);
		echo json_encode($data);
	}

	
	function isLoggedIn(){
		echo $this->session->userdata('logged_in');
	}
	
	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home','refresh');
	}
	
	function getAge($year,$month,$day){
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($day_diff < 0 || $month_diff < 0){
			$year_diff--;
		}
		return $year_diff;
	}
}
