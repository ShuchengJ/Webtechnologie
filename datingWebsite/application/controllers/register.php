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
		$data['logged_in'] = $this->session->userdata('logged_in');
		$this->load->view('header_view',$data);
		if(null == ($this->session->userdata('register_step'))){
			$this->session->set_userdata('register_step','1');
		}
		
		$step = $this->session->userdata('register_step');
		switch ($step){
			case 1: $this->load->view('register_view'); break;
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
				'v1' => ['n'=>'1', 
				'a'=>'Ik geef de voorkeur aan grote groepen mensen, met een grote diversiteit.', 
				'b'=>'Ik geef de voorkeur aan intieme bijeenkomsten met uitsluitend goede vrienden.', 
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v2' => ['n'=>'2', 
				'a'=>'Ik doe eerst, en dan denk ik.', 
				'b'=>'Ik denk eerst, en dan doe ik.', 
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v3' => ['n'=>'3',
				'a'=>'Ik ben makkelijk afgeleid, met minder aandacht voor een enkele specifieke taak.',
				'b'=>'Ik kan me goed focussen, met minder aandacht voor het grote geheel.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v4' => ['n'=>'4',
				'a'=>'Ik ben een makkelijke prater en ga graag uit.',
				'b'=>'Ik ben een goede luisteraar en meer een priv&eacute;-persoon.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v5' => ['n'=>'5',
				'a'=>'Als gastheer/-vrouw ben ik altijd het centrum van de belangstelling.',
				'b'=>'Als gastheer/-vrouw ben altijd achter de schermen bezig om te zorgen dat alles soepeltjes verloopt.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v6' => ['n'=>'6',
				'a'=>'Ik geef de voorkeur aan concepten en het leren op basis van associaties.',
				'b'=>'Ik geef de voorkeur aan observaties en het leren op basis van feiten.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v7' => ['n'=>'7',
				'a'=>'Ik heb een groot inbeeldingsvermogen en heb een globaal overzicht van een project.',
				'b'=>'Ik ben pragmatisch ingesteld en heb een gedetailleerd beeld van elke stap.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v8' => ['n'=>'8',
				'a'=>'Ik kijk naar de toekomst.',
				'b'=>'Ik houd mijn blik op het heden gericht.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v9' => ['n'=>'9',
				'a'=>'Ik houd van de veranderlijkheid in relaties en taken.',
				'b'=>'Ik houd van de voorspelbaarheid in relaties en taken.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v10' => ['n'=>'10',
				'a'=>'Ik overdenk een beslissing helemaal.',
				'b'=>'Ik beslis met mijn gevoel.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v11' => ['n'=>'11',
				'a'=>'Ik werk het beste met een lijst plussen en minnen.',
				'b'=>'Ik beslis op basis van de gevolgen voor mensen.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v12' => ['n'=>'12',
				'a'=>'Ik ben van nature kritisch.',
				'b'=>'Ik maak het mensen graag naar de zin.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v13' => ['n'=>'13',
				'a'=>'Ik ben eerder eerlijk dan tactisch.',
				'b'=>'Ik ben eerder tactisch dan eerlijk.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v14' => ['n'=>'14',
				'a'=>'Ik houd van vertrouwde situaties.',
				'b'=>'Ik houd van flexibele situaties.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v15' => ['n'=>'15',
				'a'=>'Ik plan alles, met een to-do lijstje in mijn hand.',
				'b'=>'Ik wacht tot er meerdere idee&eumln opborrelen en kies dan on-the-fly wat te doen.',
				'c'=>'k zit er eigenlijk tussenin.'],
				'v16' => ['n'=>'16',
				'a'=>'Ik houd van het afronden van projecten.',
				'b'=>'Ik houd van het opstarten van projecten.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v17' => ['n'=>'17',
				'a'=>'Ik ervaar stress door een gebrek aan planning en abrupte wijzigingen.',
				'b'=>'Ik ervaar gedetailleerde plannen als benauwend en kijk uit naar veranderingen.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v18' => ['n'=>'18',
				'a'=>'Het is waarschijnlijker dat ik een doel bereik.',
				'b'=>'Het is waarschijnlijker dat ik een kans zie.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
				'v19' => ['n'=>'19',
				'a'=>'All play and no work maakt dat het project niet afkomt.',
				'b'=>'All work and no play maakt je maar een saaie pief.',
				'c'=>'Ik zit er eigenlijk tussenin.'],
		];
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