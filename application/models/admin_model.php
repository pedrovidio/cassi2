<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

  private $table = 'admin';

	function __construct()
	{
		parent::__construct();
	}

	public function findOne($user, $password) {
		$this->db->select('id');
		$this->db->where('user',$user);
		$this->db->where('password',$password);
		$admin = $this->db->get($this->table)->result();
		return ($admin)? $admin[0]->id : null;
	}

	public function update($id, $data){
		$this->db->where('id',$id);
		return $this->db->update($this->table, $data);
	}
}
