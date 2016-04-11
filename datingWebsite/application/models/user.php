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
}
?>