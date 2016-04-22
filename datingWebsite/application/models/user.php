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
		
		$age = $this->getAge($day, $month, $year);
		
		$ageran = $userData['age'];
		$agerange = explode(" ", $ageran);
		
		$brands = $userData['brands'];
		$description = $userData['description'];
		
		$statement = 'INSERT INTO users (nickname,fullname,email,password,age,day,month,year,
				gender,interest,agemin,agemax,brands,description) 
				
				VALUES ('.$this->db->escape($nickname).',
						'.$this->db->escape($fullname).',
						'.$this->db->escape($email).', 
						'.$this->db->escape($password).',
						'.$this->db->escape($age).',
						'.$this->db->escape($day).',
						'.$this->db->escape($month).',
						'.$this->db->escape($year).',
						'.$this->db->escape($gender).',
						'.$this->db->escape($interest).',
						'.$this->db->escape($agerange[0]).',
						'.$this->db->escape($agerange[2]).',
						'.$this->db->escape($brands).',
						'.$this->db->escape($description).')';
		
		$query = $this->db->query($statement);
		
		$ownEI = $userData['personality']['ei'];
		$ownNS = $userData['personality']['ns'];
		$ownTF = $userData['personality']['tf'];
		$ownJP = $userData['personality']['jp'];
		$wantedEI = $userData['wanted']['ei'];
		$wantedNS = $userData['wanted']['ns'];
		$wantedTF = $userData['wanted']['tf'];
		$wantedJP = $userData['wanted']['jp'];
		
		$secondStatement = 'INSERT INTO personalities (id,ownEI,ownNS,ownTF,ownJP,
				wantedEI,wantedNS,wantedTF,wantedJP)
				
		VALUES ('.$this->db->escape($email).',
						'.$this->db->escape($ownEI).', 
						'.$this->db->escape($ownNS).',
						'.$this->db->escape($ownTF).',
						'.$this->db->escape($ownJP).',
						'.$this->db->escape($wantedEI).',
						'.$this->db->escape($wantedNS).',
						'.$this->db->escape($wantedTF).',
						'.$this->db->escape($wantedJP).')';
		
		$query = $this->db->query($secondStatement);
		
		return $query;
	}
	
	function getUserInformation($key){
		$this->db->select();
		$this->db->from('users');
		$this->db->where('email',$key);
		$this->db->limit(1);
		
		$query1 = $this -> db -> get();
		
		$this->db->select();
		$this->db->from('personalities');
		$this->db->where('id',$key);
		$this->db->limit(1);
		
		$query2 = $this -> db -> get();
		
		if($query1 -> num_rows() == 1 && $query2 -> num_rows() == 1){
			return array_merge($query1->result_array()[0],$query2->result_array()[0]);
		}else{
			return false;
		}
	}
	
	function changeUserInformation($key,$userData){
		$this->db->where('email',$key);
		$this->db->update('users',$userData);
	}
	
	function getRandomMatch(){
		$this->db->select('nickname, gender,month,day,year,email');
		$this->db->from('users');
		$query = $this -> db -> get();
		
		$result = $query->result_array();
		shuffle($result);
		return array_slice($result, 0,6);
	}
	
	// For the anonymous user
	// Update iteration to get the next six. 
	function getSearchedMatch($gender, $age, $brands, $personality, $iteration){
		$ownPersonality = array('ei'=>100 - $personality['ei'],
					'ns'=>100 - $personality['ns'],
					'tf'=>100 - $personality['tf'],
					'jp'=>100 - $personality['jp']);
		$data = array('interest'=>$gender, 
				'age'=>$age,
				'brands'=>$brands,
				'personality'=>$ownPersonality,
				'wanted'=>$personality);
		return $this->getMatch($data, $iteration, false);
	}
	
	// For the user with a profile
	// Update iteration to get the next six.
	function getCompleteMatch($data, $iteration){
		$personality = array('ei'=>$data['ownEI'],
				'ns'=>$data['ownNS'],
				'tf'=>$data['ownTF'],
				'jp'=>$data['ownJP']);
		
		$ownPersonality = array('ei'=>100 - $data['ownEI'],
				'ns'=>100 - $data['ownNS'],
				'tf'=>100 - $data['ownTF'],
				'jp'=>100 - $data['ownJP']);
		
		$data1 = array('interest'=>$data['interest'],
				'age'=>$data['agemin']." 0 ".$data['agemax'],
				'brands'=>$data['brands'],
				'personality'=>$ownPersonality,
				'wanted'=>$personality,
				'email'=>$data['email'],
				'gender'=>$data['gender'],
				'agemin'=>$data['agemin'],
				'agemax'=>$data['agemax']
		);
		
		
		return $this->getMatch($data1, $iteration, true);
	}
	
	function getMatch($data, $iteration, $Complete){
		// Gets the data from the first table
		$result;
		if($Complete)
			$result = $this->databaseComplete($data);
		else 
			$result = $this->databaseSearch($data);
		
		if(!$result)
			return $result;
		
		// Gets the data from the second table
		$this->db->select('ownEI,ownNS,ownTF,ownJP,
				wantedEI,wantedNS,wantedTF,wantedJP');
		$this->db->from('personalities');
		for ($y = 0; $y < sizeof($result); $y++){
			$this->db->or_where('id',$result[$y]['email']);
		}
		$secondQuery = $this -> db -> get();
		$secondResult = $secondQuery->result_array();
		
		//Sorting by distance
		$x = 0.5;
		$order;
		for ($y = 0; $y < sizeof($secondResult); $y++){
			$own = array('ei'=>$secondResult[$y]['ownEI'],
					'ns'=>$secondResult[$y]['ownNS'],
					'tf'=>$secondResult[$y]['ownTF'],
					'jp'=>$secondResult[$y]['ownJP']);
			$wanted = array('ei'=>$secondResult[$y]['wantedEI'],
					'ns'=>$secondResult[$y]['wantedNS'],
					'tf'=>$secondResult[$y]['wantedTF'],
					'jp'=>$secondResult[$y]['wantedJP']);
			$result['personality'] = $own;
			$brandsDistance = $this->getBrandsDist($data['brands'], $result[$x]['brands']);
			$atob = $this->getPersonalityDistance($data['personality'],$wanted);
			$btoa = $this->getPersonalityDistance($own,$data['wanted']);
			$maximum = max($atob, $btoa);
			$order[$result[$y]['email']] = $x * $brandsDistance + $x * $maximum;
		}
		asort($order, SORT_REGULAR);
		$order = array_keys($order);
		$answer;
		for ($y = 0; $y < sizeof($order); $y++){
			$answer[$y] = $result[array_search($order[$y], array_column($result, 'email'))];
		}
	
		return array_slice($answer, $iteration * 6, $iteration * 6 + 6);
	}
	
	function getPersonalityDistance($firstArray, $secondArray){
		$extrovert = abs($firstArray['ei'] - $secondArray['ei']);
		$intuitive = abs($firstArray['ns'] - $secondArray['ns']);
		$thinking = abs($firstArray['tf'] - $secondArray['tf']);
		$judging = abs($firstArray['jp'] - $secondArray['jp']);
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

	function getBrandsDist($firstString, $SecondString){
		return $this->getBrandsDistance(explode(" ", $firstString), explode(" ", $SecondString));
	}
	
	function getAge($day, $month, $year){
		$string = $year."-".$month."-".$day;
		$from = new DateTime($string);
		$to   = new DateTime('today');
		return $from->diff($to)->y;
	}
	
	function databaseComplete2($data){
		$this->db->select('nickname,age,day,month,year,gender,email,
				brands,description');
		$this->db->from('users');
		$age = $this->getAge($data['day'], $data['month'], $data['year']);
		$ageran = $data['age'];
		$agerange = explode(" ", $ageran);
		$minage = $agerange[0];
		$maxage = $agerange[2];
		
		if($data['interest'] != 'Both')
			$this->db->where('gender',$data['interest']);
		$this->db->where('interest',$data['gender']);
		$this->db->where('age >=', $minage);
		$this->db->where('age <=', $maxage);
		$this->db->where('agemin <=', $age);
		$this->db->where('agemax >=', $age);
		$this->db->where('email !=', $data['email']);
		$this->db->or_where('interest','Both');
		
		if($data['interest'] != 'Both')
			$this->db->where('gender',$data['interest']);
		$this->db->where('age >=', $minage);
		$this->db->where('age <=', $maxage);
		$this->db->where('agemin <=', $age);
		$this->db->where('agemax >=', $age);
		$this->db->where('email !=', $data['email']);
		
		$query = $this -> db -> get();
		return $query->result_array();
	}
	
	function databaseComplete($data){
		
		$this->db->select('nickname,age,day,month,year,gender,email,gender,interest,
				brands,description');
		$this->db->from('users');
		
		$where = "(interest='Both' OR interest='".$data['gender']."')";
		$this->db->where($where);
		
		
		if($data['interest'] != 'Both'){
			$this->db->where('gender',$data['interest']);
		}
		$this->db->where('age >=', $data['agemin']);
		$this->db->where('age <=', $data['agemax']);
		$this->db->where('agemin <=', $data['age']);
		$this->db->where('agemax >=', $data['age']);
		$this->db->where('email',$data['email']);
		$query = $this -> db -> get();
		return $query->result_array();
	}
	
	function databaseSearch($data){
		$this->db->select('nickname,age,day,month,year,gender,email,
				brands,description');
		$this->db->from('users');
		$ageran = $data['age'];
		$agerange = explode(" ", $ageran);
		$minage = $agerange[0];
		$maxage = $agerange[2];
		
		if($data['interest'] != 'Both')
			$this->db->where('gender',$data['interest']);
		$this->db->where('age >=', $minage);
		$this->db->where('age <=', $maxage);
		
		$query = $this -> db -> get();
		return $query->result_array();
	}
}
?>