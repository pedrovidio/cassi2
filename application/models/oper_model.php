<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oper_model extends CI_Model {
	private $table = 'opers';
	function __construct()
	{
		parent::__construct();
	}

	public function all() {
		$this->db->order_by('active', 'desc');
    $opers = $this->db->get($this->table)->result_array();

		if($opers){
      return $opers;
    }
		return null;
	}

	public function findActive(){
		$this->db->where('active', 1);
    return $this->db->get($this->table)->result_array();
	}

	public function findById($id) {
		$this->db->where('id', $id);
    $opers = $this->db->get($this->table)->result_array();

		if($opers){
      return $opers[0];
    }
		return null;
	}

	public function add($data){
		$this->db->insert($this->table, $data);
    return $this->db->insert_id();
	}

	public function update($id, $data){
		$this->db->where('id',$id);
		return $this->db->update($this->table, $data);
	}

	public function delete($id){
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}
	
}
