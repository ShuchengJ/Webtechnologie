<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function getTestData()
	{
		return $this->db->get('user')->result();
	}
}
