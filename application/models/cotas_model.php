<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cotas_model extends CI_Model {
	private $table = 'cotas';
	function __construct()
	{
		parent::__construct();
	}

	public function all() {
		$this->db->order_by('status');
    return $this->db->get($this->table)->result_array();
	}

	public function findById($id) {
		$this->db->where('id', $id);
		$data = $this->db->get($this->table)->result_array();

		return $data[0];
	}

	public function findOneUfTipo($cota) {
		$this->db->where('cotas', $cota);
		return $this->db->get($this->table)->result();
	}

	public function countCota($id){
		$this->db->select('meta, qtd');
		$this->db->where('id', $id);
		$row = $this->db->get($this->table)->result_array();

		return $row[0];
	}

	public function add($data){
		$this->db->insert($this->table, $data);
    return $this->db->insert_id();
	}

	public function updateCotaRespondentes($cotas_id, $statusCota){
		$respondentes['statusCota'] = $statusCota;
		$this->db->where('cotas_id',$cotas_id);
		return $this->db->update('respondentes', $respondentes);
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
