<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	private $table = 'opers';

	function __construct()
	{
		parent::__construct();
	}

	public function validate($user, $password) {
		$this->db->select('id');
		$this->db->where('user',$user);
		$this->db->where('password',$password);
		$login = $this->db->get($this->table)->result();
		return ($login)? $login[0]->id : null;
	}

	public function update($id, $data){
		$this->db->where('id',$id);
		return $this->db->update($this->table, $data);
	}
}
