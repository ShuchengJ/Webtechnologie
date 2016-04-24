<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user','',TRUE);
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{	
		if($this -> session -> userdata('logged_in')){
			$data['loggedin'] = $this->session->userdata('logged_in');
			$data['email'] = $this->session->userdata('email');
			$data['admin'] = $this->session->userdata('admin');
			$profile = $this->user->getUserInformation($data['email']); //TODO:: this should be PK ID
			$data['profile'] = $profile;
			
		}else{
			$data['loggedin'] = FALSE;
		}
		$this->load->view('Header_view',$data);
		$this->load->view('Profile_view',$data);	
		//$this->load->view('upload_form', array('error' => ' ' ));
		
	}
	
	function change(){
			$email = $this->session->userdata('email');
			$password = $this->input->post('password');
			$id = $this->user->getUserInformation($email)['id'];
			$correct = $this->user->login($email,$password);
			if(!$correct){
				echo "Something went wrong";
				return;
			}
			$newPass = $this->input->post('newPass');
			if($newPass == ''){
				$newPass = $password;
			}
			
			$age = $this->input->post('age');
			$agerange = explode(" ", $age);
			
			$userData = array(
					'nickname'=>$this->input->post('nickname'),
					'fullname'=>$this->input->post('fullname'),
					'email'=>$this->input->post('email'),
					'password'=>MD5($newPass),
					'day'=>$this->input->post('day'),
					'month'=>$this->input->post('month'),
					'year'=>$this->input->post('year'),
					'gender'=>$this->input->post('gender'),
					'interest'=>$this->input->post('interest'),
					'agemin'=>$agerange[0],
					'agemax'=>$agerange[2],
					'brands'=>$this->input->post('brands'),
					'description'=>$this->input->post('description')
			);
			$this->user->changeUserInformation($id,$userData);
			$this->session->set_userdata('email',$this->input->post('email'));
			$newUserData = array_merge($this->session->userdata('profile'),$userData);
			$this->session->set_userdata('profile',$newUserData);
			redirect('profile','auto');
			
	}
	//TODO .. this no good workiework yet.. =( naja .. eh ja
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
	
		$this->load->library('upload', $config);
	
		$data['loggedin'] = $this->session->userdata('logged_in');
		$data['email'] = $this->session->userdata('email');
		$profile = $this->user->getUserInformation($data['email']); //TODO:: this should be PK ID
		$data['profile'] = $profile;
		
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
	}
	
	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home','refresh');
	}
}
