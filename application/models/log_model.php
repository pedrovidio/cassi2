<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
  private $table = 'logs';

	function __construct()
	{
		parent::__construct();
  }

  public function last($opers_id){
    $this->db->select_max('id');
    $this->db->where('opers_id', $opers_id);
    $row = $this->db->get($this->table)->result_array();

    $idCota = ($row)? $row[0]['id'] : null;
    return $idCota;
  }
  
  public function add($data){
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($data, $id){
    $this->db->where('id',$id);
		return $this->db->update($this->table, $data);
  }
}
