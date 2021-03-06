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
			$data['admin'] = $this->session->userdata('admin');
		}else{
			$data['loggedin'] = FALSE;
		}
		$this->session->set_userdata('searchstep',0);
		$this->load->view('Header_view',$data);
		$this->load->view('Home_view',$data);
	}
	
	function match_get(){
		$loggedin = $this->session->userdata('logged_in');
		if(!$loggedin){
		$profiles = $this->user->getRandomMatch();
		}else{
			$profiles = $this->user->getCompleteMatch($this->session->userdata('profile'),$this->session->userdata('searchstep'));
			$this->session->set_userdata('searchstep',$this->session->userdata('searchstep') + 1);
		}
		for ($x = 0; $x < count($profiles); $x++) {
			if($loggedin){
			$status = $this->checkLikes($profiles[$x]['email']);
			}else{
			$status = 0;
			}
			$age = $this->getAge($profiles[$x]['year'],$profiles[$x]['month'],$profiles[$x]['day']);
			$data[$x] = array('nickname'=>$profiles[$x]['nickname'],
							  'gender'=>$profiles[$x]['gender'],
							  'id'=>$profiles[$x]['email'],
							  'age'=>$age,
							  'description'=>$profiles[$x]['description'],
							  'brands'=>$profiles[$x]['brands'],
							  'image'=>'none', //TODO add db and retrieval images
							  'status'=>$status
			);
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
	
	function search(){
		$personality = array('ei'=>$this->input->post('PersonEI'),
				'ns'=>$this->input->post('PersonNS'),
				'tf'=>$this->input->post('PersonFT'),
				'jp'=>$this->input->post('PersonJP'));
		
		if($this->session->userdata('logged_in')){
			$status = $this->checkLikes($profiles[$x]['email']);
			$data = $this->session->userdata('profile');
			$ownPersonality = array('ei'=>100 - $data['ownEI'],
					'ns'=>100 - $data['ownNS'],
					'tf'=>100 - $data['ownTF'],
					'jp'=>100 - $data['ownJP']);
			
			$profiles = $this->user->getSearchedCompleteMatch($this->input->post("gender"),
			$this->input->post("age"), $this->input->post("brands"), $ownPersonality, $personality,0);
		}
		
		else{
			$profiles = $this->user->getSearchedMatch($this->input->post("gender"),
			$this->input->post("age"), $this->input->post("brands"), $personality, 0);
			$status = 0;
		}
		for ($x = 0; $x < count($profiles); $x++) {
			$age = $this->getAge($profiles[$x]['year'],$profiles[$x]['month'],$profiles[$x]['day']);
			$data[$x] = array('nickname'=>$profiles[$x]['nickname'],
							  'gender'=>$profiles[$x]['gender'],
							  'id'=>$profiles[$x]['email'],
							  'age'=>$age,
							  'description'=>$profiles[$x]['description'],
							  'brands'=>$profiles[$x]['brands'],
							  'image'=>'none', //TODO add db and retrieval images
							  'status'=>$status
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
		redirect('Home','refresh');
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