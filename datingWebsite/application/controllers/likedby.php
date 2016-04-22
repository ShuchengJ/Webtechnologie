<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Likedby extends CI_Controller  {

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
		echo var_dump($this->session->userdata('like'));
		$this->load->view('header_view',$data);
		$this->load->view('likedby_view',$data);
		
		
	}
	
	function match_get(){
		$loggedin = $this->session->userdata('logged_in');
		if(!$loggedin){
		$profiles = $this->user->getRandomMatch();
		}else{
			
			$profiles = $this->user->getCompleteMatch($this->session->userdata('profile'),0);
		}
		
		for ($x = 0; $x < count($profiles); $x++) {
			if($loggedin){
			$status = $this->checkLikes($profiles[$x]['email']);
			}
			
			
			$age = $this->getAge($profiles[$x]['year'],$profiles[$x]['month'],$profiles[$x]['day']);
			if($status == 1){
			$data[] = array('nickname'=>$profiles[$x]['nickname'],
							  'gender'=>$profiles[$x]['gender'],
							  'id'=>$profiles[$x]['email'],
							  'age'=>$age,
							  'image'=>'none', //TODO add db and retrieval images
							  'status'=>$status
			);
			}
		}
		
		$this->session->set_userdata('matches',$profiles);
		if(count($data) != 0){
			echo json_encode($data);
		}
	}
	//see if user likes / is liked by this user
	//0 no likes
	//1 user likes other
	//2 other likes user
	//3 both like eachother
	function checkLikes($otherUser){
		$status = $this->session->userdata('like');
		$output = 0;
		if(in_array($otherUser, $status['likes'])){
			//user likes other
			$output = 1;
			if(in_array($otherUser,$status['likedby'])){
				//both like
				$output = 3;
			}else{
				$output = 2;
			}
		}
		return $output;
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
?>