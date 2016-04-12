<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connections extends CI_Model {

	function addLike($user,$liked){
		//get likes given by user.
		$this->db->select('likes');
		$this->db->from('connections');
		$this->db->where('id',$user);
		$query = $this -> db -> get();
		
		//add new like
		$likedField = $query->row()->likes;
		$likedField .= ','.$liked; 
		$input['likes'] = $likedField;
		
		//insert the new like
		$this->db->where('id',$user);
		$this->db->update('connections',$input);
		
		$this->addLikedBy($liked, $user);
	}
	
	function addLikedBy($user,$likedby){
		$this->db->select('likedby');
		$this->db->from('connections');
		$this->db->where('id',$user);
		$query = $this -> db -> get();
		
		$likedByField = $query->row()->likedby;
		$likedByField .= ','.$likedby;
		$input['likedby'] = $likedByField;
		
		$this->db->where('id',$user);
		$this->db->update('connections',$input);	
	}
	
	function getLikeInformation($user){
		$this->db->select('likes,likedby');
		$this->db->from('connections');
		$this->db->where('id',$user);
		$query = $this -> db -> get();
		
		
		$likes =  $query->row()->likes;
		$likedby = $query->row()->likedby;
		
		return array('likes'=>explode(',', $likes),
					'likedby'=>explode(',',$likedby)
		);
	}
}
?>