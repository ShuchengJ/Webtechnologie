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
		$email = $userData['email'];
		$password = MD5($userData['password']);
		$pdata = $userData['personality']['q'];
		$statement = 'INSERT INTO users (email,password,q) VALUES ('.$this->db->escape($email).', '.$this->db->escape($password).','.$this->db->escape($pdata).')';
		$query = $this->db->query($statement);
		
		return $query;
	}
}
?>