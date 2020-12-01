<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
  private $table = 'logs';

	function __construct()
	{
		parent::__construct();
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
