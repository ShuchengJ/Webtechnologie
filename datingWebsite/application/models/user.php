<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	function login($email,$password)
	{
		$this->db->select('id,email,password');
		$this->db->from('users');
		$this->db->where('email',$email);
		$this->db->where('password',MD5($password));
		$this->db->limit(1);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() == 1){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function register($userData){
		//just name and password for now
		
		$nickname = $userData['nickname'];
		$fullname = $userData['fullname'];
		$email = $userData['email'];
		$password = MD5($userData['password']);
		$day = $userData['day'];
		$month = $userData['month'];
		$year = $userData['year'];
		$gender = $userData['gender'];
		$interest = $userData['interest'];
		
		$age = $userData['age'];
		$agerange = explode(" ", $age);
		
		$brands = $userData['brands'];
		$description = $userData['description'];
		$ei = $userData['personality']['ei'];
		$ns = $userData['personality']['ns'];
		$tf = $userData['personality']['tf'];
		$jp = $userData['personality']['jp'];
		
		$statement = 'INSERT INTO users (nickname,fullname,email,password,day,month,year,
				gender,interest,agemin,agemax,brands,description,ei,ns,tf,jp) 
				
				VALUES ('.$this->db->escape($nickname).',
						'.$this->db->escape($fullname).',
						'.$this->db->escape($email).', 
						'.$this->db->escape($password).',
						'.$this->db->escape($day).',
						'.$this->db->escape($month).',
						'.$this->db->escape($year).',
						'.$this->db->escape($gender).',
						'.$this->db->escape($interest).',
						'.$this->db->escape($agerange[0]).',
						'.$this->db->escape($agerange[2]).',
						'.$this->db->escape($brands).',
						'.$this->db->escape($description).',
						'.$this->db->escape($ei).',
						'.$this->db->escape($ns).',
						'.$this->db->escape($tf).',
						'.$this->db->escape($jp).')';
		
		$query = $this->db->query($statement);
		
		return $query;
	}
	
	function getUserInformation($key){
		$this->db->select();
		$this->db->from('users');
		$this->db->where('email',$key);
		$this->db->limit(1);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() == 1){
			return $query->result_array()[0];
		}else{
			return false;
		}
	}
	
	function changeUserInformation($key,$userData){
		$this->db->where('id',$key);
		$this->db->update('users',$userData);
	}
	
	function getRandomMatch(){
		$this->db->select('nickname, gender,month,day,year,id');
		$this->db->from('users');
		$query = $this -> db -> get();
		
		$result = $query->result_array();
		shuffle($result);
		return array_slice($result, 0,6);
	}
	
	function getSearchedMatch($gender){
		
		$this->db->select('nickname,gender,month,day,year,id');
		$this->db->from('users');
		if($gender != 'Both'){
			$this->db->where('gender',$gender);
		}
		// Needs age
		$query = $this -> db -> get();
		$result = $query->result_array();
		
		//Sort them here
		shuffle($result);
		
		return array_slice($result, 0,6);
	}
	
	function getCompleteMatch($data){
		// Array needs gender, interest, year, age, personality, brands
		$this->db->select('nickname,day,month,year,gender,
				brands,description,ei,ns,tf,jp');
		$this->db->from('users');
		
		$age = $data['age'];
		$agerange = explode(" ", $age);
		$minage = $agerange[0];
		$maxage = $agerange[2];
		if($data['interest'] != 'Both'){
			$this->db->where('gender',$data['interest']);
			$this->db->where('interest',$data['gender']);
			$this->db->or_where('interest','Both');
			$this->db->where('year <', date("Y") - $minage);
			$this->db->where('year >', date("Y") - $maxage);
			$this->db->where('minage >', date("Y") - $data['year']);
			$this->db->where('maxage <', date("Y") - $data['year']);
		}
		// Needs age
		$query = $this -> db -> get();
		$result = $query->result_array();
	
		//Sort them here
		shuffle($result);
	
		return array_slice($result, 0,6);
	}
	
	function getPersonalityDistance($firstArray, $secondArray){
		$extrovert = $firstArray['ei'] - $secondArray['ei'];
		$intuitive = $firstArray['nd'] - $secondArray['ns'];
		$thinking = $firstArray['tf'] - $secondArray['tf'];
		$judging = $firstArray['jp'] - $secondArray['jp'];
		$sum = $extrovert + $intuitive + $thinking + $judging;
		return $sum / 400;
	}
	
	function getBrandsDistance($firstArray, $secondArray){
		$overlap = array_intersect($firstArray, $secondArray);
		$dividend = 2 * sizeof($overlap);
		$divisor = sizeof($firstArray) + sizeof($secondArray);
		if($divisor == 0)
			$divisor = 1;
		return 1 - ($dividend / $divisor);
	}
	
	function getArrayBrands(){
		
	}
}
?>